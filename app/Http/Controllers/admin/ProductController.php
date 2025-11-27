<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class ProductController extends Controller
{
     public function index()
    {
        $products = Product::all();
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        return view('admin.product.create');
    }

    public function store(Request $request)
    {


        $request->validate([
            'title' => 'required',
            'image' => 'required',
            'price' => 'required',
            'desc' => 'required',


        ]);
        $imageName = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = rand() . '_' . $image->getClientOriginalName();
            $image->move(public_path('product_img'), $imageName);
        }
        $slug = Str::slug($request->title);

        $product = new Product();
        $product->title = $request->input('title');
        $product->slug = $slug;
        $product->image = 'product_img/' . $imageName;
        $product->price = $request->input('price');
        $product->desc = $request->input('desc');
        $product->save();
        return redirect()->route('admin.product')->with('success', 'Product added successfully!');
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if (File::exists($product->image)) {
            File::delete($product->image);
        }
        $product->delete();
        return redirect()->back()->with('success', "Product deleted Successfully");
    }
    public function show($id)
    {
        $product = Product::find($id);
        return view('admin.product.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if ($request->hasFile('image')) {
            if (File::exists($product->image)) {
                File::delete($product->image);
            }
            $imageName = rand() . '.' . $request->image->extension();
            $request->image->move('product_img', $imageName);
            $product->image = 'product_img/' . $imageName;
        }

        $product->title = $request->input('title');
        $product->slug = Str::slug($request->title);
        $product->price = $request->input('price');
        $product->desc = $request->input('desc');
        $product->save();
        return redirect()->route('admin.product')->with('success', 'Product updated successfully!');
    }
}
