<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductGallery;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Product::query()->with('category', 'galleries');
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {

                    $edit = '<a href=" ' . route('admin.products.edit', $data->id) . ' " class="edit btn btn-primary btn-sm">Edit</a>';
                    $delete = '<a href="javascript:void(0)" onClick="Delete(this.id)" id="' . $data->id . '" class="delete btn btn-danger btn-sm">Delete </a>';

                    return $edit . ' ' . $delete;
                })
                ->editColumn('categories_id', function ($row) {
                    return $row->category->name;
                })
                ->editColumn('price', function ($row) {
                    return moneyFormat($row->price);
                })
                ->addColumn('image', function ($row) {
                    $image = $row->galleries->first();
                    if ($image) {
                        return '<img src="' . Storage::url($image->photos) . '" width="100px" height="100px">';
                    } else {
                        return 'Tidak ada gambar';
                    }
                })
                ->rawColumns(['action', 'image'])
                ->make(true);
        }

        return view('pages.admin.products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('pages.admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validasi data
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'description' => 'required|string',
            'categories_id' => 'required|integer',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        // Create Product
        $product = Product::create($data);

        $data['photos'] = $request->file('photo')->store('assets/products', 'public');
        $data['product_id'] = $product->id;
        // Craete Product Gallery
        ProductGallery::create($data);
        return redirect()->route('admin.products.index')->with('success', 'Data berhasil ditambahkan');
        // simpan data ke database

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
        $product = Product::with('galleries', 'category')->findOrFail($id);
        $categories = Category::all();
        return view('pages.admin.products.edit', compact('product', 'categories'));
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
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'description' => 'required|string',
            'categories_id' => 'required|integer',
        ]);
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $product = Product::findOrFail($id);
        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete product
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(['status' => 'success']);
    }

    public function productGalleryDelete($id)
    {
        $gallery = ProductGallery::findOrFail($id);
        if (Storage::exists('public/' . $gallery->photos)) {

            Storage::disk('local')->delete('public/' . $gallery->photos);
        }
        $gallery->delete();

        return redirect()->route('admin.products.edit', $gallery->product_id)->with('success', 'Data berhasil dihapus');
    }

    public function productGalleryUpload(Request $request)
    {
        $data = $request->all();
        $data['photos'] = $request->file('photos')->store('assets/products', 'public');
        $data['product_id'] = $request->product_id;
        ProductGallery::create($data);
        return redirect()->route('admin.products.edit', $request->product_id)->with('success', 'Data berhasil ditambahkan');
    }
}
