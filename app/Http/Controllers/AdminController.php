<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('Admin.normal');
    }
    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:8'],
        ]);
        $datas = User::where('id', auth()->user()->id)
            ->update([
                'password' => Hash::make($request->password),
            ]);
        if ($datas) {
            return redirect()->back()->with('success', 'You have updated Your Profile');
        }
    }
}
