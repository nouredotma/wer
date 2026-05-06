<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function loginPage()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $admin = Admin::where('username', $request->username)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            session(['admin' => $admin->id]);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['username' => 'Invalid credentials']);
    }

    public function logout()
    {
        session()->forget('admin');
        return redirect()->route('admin.login');
    }
}
