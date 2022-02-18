<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->get();
        return view('product.index', compact('products'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'description' => 'required',
            'quantity' => 'required',
            'purchase_price' => 'required',
            'sales_price' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ]);
        $newImage = time() . "." . $request->image->extension();
        $request->image->move(base_path('public/storage/images'), $newImage);
        $datas = Product::create([
            'product_name' => $request->product_name,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'purchase_price' => $request->purchase_price,
            'sales_price' => $request->sales_price,
            'image' => $newImage,
        ]);
        if ($datas) {
            return redirect()->back()->with('success', 'Product Inserted !');
        }
    }
    public function edit($productId)
    {
        $product = Product::findOrFail($productId);
        return view('product.edit', compact('product'));
    }
    public function update(Request $request, $productId)
    {
        // dd($request->all());
        $request->validate([
            'product_name' => 'required',
            'description' => 'required',
            'quantity' => 'required',
            'purchase_price' => 'required',
            'sales_price' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ]);
        $newImage = "";
        $product = Product::findOrFail($productId);
        if (isset($request->image)) {
            unlink(base_path('public/storage/images/' . $product->image));
            $newImage = time() . "." . $request->image->extension();
            $request->image->move(base_path('public/storage/images'), $newImage);
        } else {
            $newImage = $product->image;
        }
        $datas = Product::where('id', $productId)
            ->update([
                'product_name' => $request->product_name,
                'description' => $request->description,
                'quantity' => $request->quantity,
                'purchase_price' => $request->purchase_price,
                'sales_price' => $request->sales_price,
                'image' => $newImage,
            ]);
        if ($datas) {
            return redirect()->route('products')->with('success', 'Product Inserted !');
        }
    }
}
