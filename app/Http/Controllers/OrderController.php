<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use PDF;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('id', 'desc')->get();
        return view('order.index', compact('orders'));
    }
    public function getCustomer()
    {
        $customers = Customer::orderBy('name', 'asc')->get();
        return view('order.getCustomer', compact('customers'));
    }
    public function setCustomer(Request $request)
    {
        // dd($request->all());
        $customer = Customer::findOrFail($request->customer_id);

        session()->get('customer_id');
        session()->put('customer_id', $request->customer_id);
        session()->get('name');
        session()->put('name', $customer->name);
        session()->get('address');
        session()->put('address', $customer->address);
        session()->get('contact');
        session()->put('contact', $customer->contact);
        return view('order.redirect');
    }
    public function getCart()
    {
        $products = Product::all();
        return view('order.cart', compact('products'));
    }
    public  function findProduct($productId)
    {
        $product = Product::findOrFail($productId);
        return response()->json($product);
    }
    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $cartItems = session()->get('cartItems', []);
        if (isset($cartItems[$request->product_id])) {
            $cartItems[$request->product_id]['quantity']++;
        } else {
            $cartItems[$request->product_id] = [
                'name' => $product->product_name,
                'sales_price' => $product->sales_price,
                'quantity' => $request->billed,
            ];
        }
        session()->put('cartItems', $cartItems);
        return redirect()->back()->with('success', 'Cart Updated !');
    }
    public function remove(Request $request)
    {
        if ($request->id) {
            $cartItems = session()->get('cartItems');
            if (isset($cartItems[$request->id])) {
                unset($cartItems[$request->id]);
                session()->put('cartItems', $cartItems);
            }
            // dd($cartItems);
            return redirect()->back()->with('success', 'Product Deleted!!!');
        }
    }
    public function checkOut()
    {
        $trigger = 0;
        $total = 0;
        // session()->get('customer_id');
        $cartItems = session()->get('cartItems');
        foreach ($cartItems as $key => $value) {
            $product = Product::findOrFail($key);
            $qty = $product->quantity;
            $cartProduct = CartItem::where('product_id', $key)->sum('billed');
            $qty2 =  $qty - $cartProduct - $value['quantity'];
            if ($qty2 < 0) {
                $trigger = 1;
            }
            $total += $value['quantity'] * $value['sales_price'];
        }
        // dd($trigger);
        if ($trigger == 0) {
            Order::create([
                'amount' => $total,
                'customer_id' => session('customer_id'),
                'user_id' => auth()->user()->id,
            ]);
            $ordered = Order::latest()->first();
            $orderid = $ordered->id;
            foreach ($cartItems as $key => $value) {
                CartItem::create([
                    'product_id' => $key,
                    'billed' => $value['quantity'],
                    'sales_price' => $value['sales_price'],
                    'order_id' => $orderid,
                ]);
            }
            return redirect()->route('orders')->with('success', 'Order created !!');
        } else {
            return redirect()->back()->with('error', 'Insufficient Stock !!');
        }
    }
    public function invoice($id)
    {
        $order = Order::findOrFail($id);
        return view('order.invoice', compact('order'));
    }
    public function invoicePDF($id)
    {
        $order = Order::findOrFail($id);
        $data = [
            'order' =>  $order,
        ];
        $pdf = PDF::loadView('order.invoicePDF', $data);
        return $pdf->download('invoice.pdf');
    }
}
