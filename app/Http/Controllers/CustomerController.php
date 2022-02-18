<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::orderBy('id', 'desc')->get();
        return view('customer.index', compact('customers'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'contact' => 'required|string',
            'address' => 'required',
        ]);
        $datas = Customer::create([
            'name' => $request->name,
            'contact' => $request->contact,
            'address' => $request->address,
        ]);
        if ($datas) {
            return redirect()->back()->with('success', 'New Customer Added !');
        } else {
            return redirect()->back()->with('error', 'Wrong Credentials !!');
        }
    }
    public function edit($customerId)
    {
        $customer = Customer::findOrFail($customerId);
        return view('customer.edit', compact('customer'));
    }
    public function update(Request $request, $customerId)
    {
        $request->validate([
            'name' => 'required|string',
            'contact' => 'required|string',
            'address' => 'required',
        ]);
        $datas = Customer::where('id', $customerId)
            ->update([
                'name' => $request->name,
                'contact' => $request->contact,
                'address' => $request->address,
            ]);
        if ($datas) {
            return redirect()->route('customers')->with('success', 'Customer Info Updated !');
        } else {
            return redirect()->back()->with('error', 'Wrong Credentials !!');
        }
    }
}
