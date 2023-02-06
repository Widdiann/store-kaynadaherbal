<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\DB;
use Midtrans\Snap;
use Midtrans\Notification;

class CheckoutController extends Controller
{
    public function __construct(Request $request)
    {
        // Set Midtrans Cofiguration
        \Midtrans\Config::$serverKey = config('services.midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized = config('services.midtrans.isSanitized');
        \Midtrans\Config::$is3ds = config('services.midtrans.is3ds');
    }

    public function checkout(Request $request)
    {
        $user = Auth::user();
        $code = 'TRX-' . mt_rand(00000, 99999);

        $carts = Cart::with(['product', 'user'])
            ->where('user_id', $user->id)
            ->get();

        DB::beginTransaction();
        try {
            // Create Transaction
            $transaction = Transaction::create([
                'code'          => $code,
                'user_id'       => $user->id,
                'total_price'   => $request->total_price,
                'status'        => 'pending',
                'name'          => $request->name,
                'phone'         => $request->phone_number,
                'kode_pos'      => $request->kode_pos,
                'address'       => $request->address,
                'province_id'   => $request->provinces_id,
                'regencies_id'  => $request->regencies_id,
                'district_id'   => $request->district_id,
            ]);

            foreach ($carts as $cart) {

                // Create Transaction Detail
                $transaction->transaction_details()->create([
                    'product_id' => $cart->product_id,
                    'price'      => $cart->product->price,
                    'quantity'   => $cart->quantity,
                ]);
                // decrement product stock
                $cart->product->decrement('quantity', $cart->quantity);
                // Delete Cart
                $cart->delete();
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('cart.index')->with('error', 'Data gagal ditambahkan ke cart !!')->withInput();
        }

        // Buat Aray untuk dikirim ke midtrans
        $midtrans = [
            "transaction_details" => [
                "order_id" => $code,
                "gross_amount" => (int) $request->total_price,
            ],
            "customer_details" => [
                "first_name" => Auth::user()->name,
                "email" => Auth::user()->email,
            ],
            "enabled_payments" => array('gopay', 'bank_transfer', 'indomaret', 'alfamart'),
            "vtweb" => []
        ];

        // dd($paymentUrl);
        try {
            $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;
            // Get Snap Payment Page URL
            $transaction->update([
                'midtrans' => $paymentUrl,
            ]);
            // Redirect to Snap Payment Page
            return redirect($paymentUrl);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function midtransCallback()
    {
        //instance midtrans notif
        $notification = new Notification();

        //assign ke variable untuk memuahka ke coding
        $status = $notification->transaction_status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud_status;
        $order_id = $notification->order_id;

        // cari transaksi berdasarkan id
        $transaction = Transaction::where('code', $order_id)->first();

        // handle notif status
        if ($status == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $transaction->status = 'pending';
                } else {
                    $transaction->status = 'success';
                }
            }
        } else if ($status == 'settlement') {

            $transaction->status = 'success';
        } else if ($status == 'pending') {
            $transaction->status = 'pending';
        } else if ($status == 'deny') {
            $transaction->status = 'failed';
        } else if ($status == 'expire') {
            $transaction->status = 'failed';
        } else if ($status == 'cancel') {
            $transaction->transaction_status = 'failed';
        }

        //simpan transaksi 
        $transaction->save();
    }
}
