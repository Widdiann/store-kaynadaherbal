<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = User::query()->where('roles', 'ADMIN')->latest();
            return DataTables()->of($query)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {

                    $edit = '<a href=" ' . route('admin.admin.edit', $data->id) . ' " class="edit btn btn-primary btn-sm">Edit</a>';
                    $delete = '<a href="javascript:void(0)" onClick="Delete(this.id)" id="' . $data->email . '" class="delete btn btn-danger btn-sm">Delete </a>';

                    return $edit . ' ' . $delete;
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->editColumn('phone', function ($row) {
                    return $row->phone ?? '-';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.admin.admin.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);
        // Simpan data ke database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'roles' => 'ADMIN',
        ]);
        // Redirect ke halaman admin
        return redirect()->route('admin.admin.index')->with('success', 'Data berhasil ditambahkan');
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
        //edit admin
        $admin = User::find($id);
        return view('pages.admin.admin.edit', compact('admin'));
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
        // update admin
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'phone' => 'required|string|max:255',
        ]);
        $admin = User::find($id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->save();
        return redirect()->route('admin.admin.index')->with('success', 'Admin updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('email', $id)->first();
        $user->delete();
        return response()->json(['status' => 'success']);
    }

    public function setting(Request $request)
    {
        return view('pages.admin.admin.setting');
    }



    public function settingUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:255',
        ]);
        $data = $request->all();

        $user = User::findOrFail(auth()->user()->id);
        if ($request->password) {
            // validasi password
            $request->validate([
                'password' => 'required|string|min:6|confirmed',
            ]);
            $data['password'] = bcrypt($request->password);
            $user->update($data);
        } else {
            $user->update([
                'name'      => $request->input('name'),
                // 'last_name' => $request->input('last_name'),
                'email'     => $request->input('email'),
                'phone'     => $request->input('phone'),
            ]);
        }
        return redirect()->route('admin.setting.index')->with('success', 'Data berhasil diubah');
    }
}
