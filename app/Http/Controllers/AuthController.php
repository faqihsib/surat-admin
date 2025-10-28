<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display login page
     */
    public function index()
    {
        return view('pages.auth.login');
    }

    /**
     * Process login
     */
    public function login(Request $request)
    {
        //dd($request->all());

        $data['email'] = $request->email;
        $data['password'] = $request->password;

        $user = User::where('email', $data['email'])->first();

        if ($user && Hash::check($data['password'], $user->password)) {
            return redirect()->route('admin.index')->with('success', 'Login Berhasil!');
        } else {
            return redirect()->route('auth.index')->with('error', 'Email atau Password Salah!');
        }
    }

    /**
     * Display register page
     */
    public function showRegister()
    {
        return view('pages.auth.register');
    }

    /**
     * Process register
     */
    public function register(Request $request)
    {
        //dd($request->all());

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);

        User::create($data);

        return redirect()->route('auth.index')->with('success', 'Registrasi Berhasil! Silakan Login.');
    }

    /**
     * Process logout
     */
    public function logout()
    {
        return redirect()->route('auth.index')->with('success', 'Logout Berhasil!');
    }
}
