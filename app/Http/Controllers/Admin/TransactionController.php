<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Province;
use App\Models\Transaction;
use Illuminate\Http\Request;
use DataTables;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Transaction::query()->with('user');
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {

                    $edit = '<a href="' . route('admin.transactions.edit', $data->id) . '" class="edit btn btn-primary btn-sm">Show</a>';
                    $delete = "";
                    if ($data->status == 'failed') {
                        $delete = '<a href="javascript:void(0)" onClick="Delete(this.id)" id="' . $data->id . '" class="delete btn btn-danger btn-sm">Delete </a>';
                    }

                    return $edit . ' ' . $delete;
                })
                ->editColumn('status', function ($data) {
                    if ($data->status == "pending") {
                        return '<span class="badge badge-warning">Pending</span>';
                    } else if ($data->status == "success") {
                        return '<span class="badge badge-success">Success</span>';
                    } else if ($data->status == "failed") {
                        return '<span class="badge badge-danger">Failed</span>';
                    }
                })
                ->editColumn('status_pengiriman', function ($data) {
                    if ($data->status_pengiriman == "PENDING") {
                        return '<span class="badge badge-warning">Pending</span>';
                    } else if ($data->status_pengiriman == "SHIPPING") {
                        return '<span class="badge badge-info">Shipping</span>';
                    } else if ($data->status_pengiriman == "SUCCESS") {
                        return '<span class="badge badge-success">Success</span>';
                    } else if ($data->status_pengiriman == "CANCEL") {
                        return '<span class="badge badge-danger">Cancel</span>';
                    }
                })

                ->editColumn('resi', function ($data) {
                    return $data->resi ?? '-';
                })
                ->editColumn('total_price', function ($data) {
                    return moneyFormat($data->total_price);
                })

                ->rawColumns(['action', 'status', 'status_pengiriman'])
                ->make(true);
        }

        return view('pages.admin.transactions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transaction = Transaction::with('transaction_details')->find($id);
        $provinces = Province::orderBy('name', 'asc')->get();
        return view('pages.admin.transactions.edit', compact('transaction', 'provinces'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // update transactions
        // validasi
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'province_id' => 'required',
            'regencies_id' => 'required',
            'kode_pos' => 'required',
            'status' => 'required',
            'total_price' => 'required',
            'resi' => 'required',
            'status_pengiriman' => 'required',
        ]);
        $transaction = Transaction::find($id);
        $transaction->update($request->all());

        return redirect()->route('admin.transactions.index')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete transaction
        $transaction = Transaction::find($id);
        $transaction->delete();
        return response()->json(['status' => 'success']);
    }
}
