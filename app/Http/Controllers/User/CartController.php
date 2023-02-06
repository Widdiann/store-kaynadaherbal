<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function index()
    {
        $carts = Cart::where('user_id', Auth::user()->id)->with('product')->get();
        return view('pages.user.cart', compact('carts'));
    }

    public function addCart($id)
    {
        $cart = Cart::where('product_id', $id)
            ->where('user_id', Auth::user()->id)
            ->first();
        if ($cart) {
            $cart->increment('quantity', request()->quantity);
        } else {
            $data = [
                'product_id' => $id,
                'user_id' => Auth::user()->id,
                'quantity' => request()->quantity,
            ];
            Cart::create($data);
        }
        return redirect()->route('cart.index')->with('success', 'Data Berhasil ditambahkan ke cart !!');
    }

    public function provinces()
    {
        return Province::orderBy('name', 'asc')->get();
    }

    public function regencies($province_id)
    {
        return Regency::where('province_id', $province_id)->get();
    }

    public function distric($regency_id)
    {
        return District::where('regency_id', $regency_id)->get();
    }

    public function destroy($id)
    {
        // delete cart
        $cart = Cart::find($id);
        $cart->delete();
        return redirect()->route('cart.index')->with('success', 'data berhasil dihapus!');
    }
}
