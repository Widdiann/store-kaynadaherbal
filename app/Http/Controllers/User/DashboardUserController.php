<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Province;
use App\Models\Transaction;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;

class DashboardUserController extends Controller
{
    public function index()
    {
        return view('pages.user.dashboard');
    }

    public function transactions()
    {
        if (request()->ajax()) {
            $query = Transaction::where('user_id', Auth::user()->id);
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('transaction', $row->id) . '" class="btn btn-primary btn-sm">Detail</a>';
                    return $btn;
                })
                ->editColumn('status', function ($row) {
                    if ($row->status == 'pending') {
                        $status = '<span class="badge bg-warning">Pending</span>';
                    } elseif ($row->status == 'success') {
                        $status = '<span class="badge bg-success">Success</span>';
                    } elseif ($row->status == 'failed') {
                        $status = '<span class="badge bg-danger">Failed</span>';
                    }
                    return $status;
                })
                ->editColumn('status_pengiriman', function ($data) {
                    if ($data->status_pengiriman == "PENDING") {
                        return '<span class="badge bg-warning">Pending</span>';
                    } else if ($data->status_pengiriman == "SHIPPING") {
                        return '<span class="badge bg-info">Shipping</span>';
                    } else if ($data->status_pengiriman == "SUCCESS") {
                        return '<span class="badge bg-success">Success</span>';
                    } else if ($data->status_pengiriman == "CANCEL") {
                        return '<span class="badge bg-danger">Cancel</span>';
                    }
                })

                ->editColumn('resi', function ($data) {
                    return $data->resi ?? '-';
                })
                ->editColumn('total_price', function ($row) {
                    return moneyFormat($row->total_price);
                })
                ->rawColumns(['action', 'status', 'total_price', 'status_pengiriman'])
                ->make(true);
        }
        return view('pages.user.transactions');
    }

    public function transaction($id)
    {
        $transaction = Transaction::find($id);
        return view('pages.user.transaction-detail', compact('transaction'));
    }

    public function setting()
    {
        return view('pages.user.setting');
    }

    public function settingAlamat(Request $request)
    {
        $provinces = Province::orderBy('name', 'asc')->get();

        return view('pages.user.alamat', compact('provinces'));
    }

    public function updateUser(Request $request)
    {
        $user = Auth::user();

        // validasi
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:255',
        ]);

        // jika password kosong
        if (isset($request->password)) {
            $this->validate($request, [
                'password' => 'required|string|min:6|confirmed',

            ]);
            $user->update([
                'name'      => $request->input('name'),
                'email'     => $request->input('email'),
                'phone'     => $request->input('phone'),
                'password' => bcrypt($request->input('password')),

            ]);
        } else {
            $user->update([
                'name'      => $request->input('name'),
                'email'     => $request->input('email'),
                'phone'     => $request->input('phone'),

            ]);
        }


        return redirect()->route('setting.user.index')->with('success', 'Data berhasil diupdate');
    }

    public function updateAlamatUser(Request $request)
    {
        $user = Auth::user();

        $this->validate($request, [
            'address' => 'required|string|max:255',
            'province_id' => 'required|integer',
            'regencies_id' => 'required|integer',
        ]);
        $user->update([
            'address'   => $request->input('address'),
            'province_id' => $request->input('province_id'),
            'regencies_id' => $request->input('regencies_id'),
        ]);
        return redirect()->route('setting.alamat')->with('success', 'Data berhasil diupdate');
    }
}
