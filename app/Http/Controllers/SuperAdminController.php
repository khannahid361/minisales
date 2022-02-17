<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SuperAdminController extends Controller
{
    public function index()
    {
        $users = User::where('role', '!=', 1)->get();
        return view('Admin.index', compact('users'));
    }
    public function createAdmin()
    {
        return view('Admin.create');
    }
    public function storeAdmin(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        $datas = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);
        if ($datas) {
            return redirect()->back()->with('success', 'New Admin Created !');
        }
    }
    public function dashboard()
    {
        return view('Admin.super');
    }
    public function updateProfile(Request $request)
    {
        return redirect()->back()->with('success', 'You have updated Your Profile');
    }
}
