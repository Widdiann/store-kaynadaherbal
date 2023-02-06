<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::paginate(6);
        $products = Product::paginate(8);

        return view('pages.home', compact('categories', 'products'));
    }

    public function kontak()
    {
        return view('pages.kontak');
    }

    public function categories()
    {
        $categories = Category::paginate(6);
        $products = Product::paginate(50);

        return view('pages.categories', compact('categories', 'products'));
    }

    public function category($slug)
    {
        $categories = Category::paginate(6);

        $category = Category::where('slug', $slug)->first();
        $products = Product::where('categories_id', $category->id)->paginate(8);
        return view('pages.category', compact('category', 'products', 'categories'));
    }

    public function productDetail($slug)
    {
        $product = Product::where('slug', $slug)->with('galleries')->first();
        return view('pages.product-detail', compact('product'));
    }

    // Midtrans Success
    public function success()
    {
        return view('pages.success');
    }

    // Midtrans Unfinish
    public function unfinish()
    {
        return view('pages.unfinish');
    }

    // Midtrans Error
    public function error()
    {
        return view('pages.error');
    }

    public function sendEmail(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'message' => 'required|string|max:255',
        ]);
        $data = $request->all();
        if ($request->copy) {
            Mail::to($request->email)->send(new SendMail($data));
        }

        Mail::to("kaynadaherbal@gmail.com")->send(new SendMail($data));


        return redirect()->back()->with('Success', 'Terimakasih telah mengirim pesan ^^');
    }
}
