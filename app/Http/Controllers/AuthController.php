<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        // 1. Validasi input wajib diisi
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. Gunakan Auth::attempt (Otomatis cek password & buat sesi)
        if (Auth::attempt($credentials)) {

            // Regenerasi sesi untuk keamanan (mencegah session fixation)
            $request->session()->regenerate();

            // Cek role user untuk debug (opsional, bisa dihapus nanti)
            // dd(Auth::user());

            return redirect()->route('admin.index')->with('success', 'Login Berhasil!');
        }

        // 3. Jika gagal
        return back()->with('error', 'Email atau Password Salah!');
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
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        // Default role jika register mandiri (misal: guest)
        $data['role'] = 'guest';

        User::create($data);

        return redirect()->route('auth.index')->with('success', 'Registrasi Berhasil! Silakan Login.');
    }

    /**
     * Process logout
     */
    public function logout(Request $request)
    {
        // Hapus sesi login
        Auth::logout();

        // Invalidasi token sesi
        $request->session()->invalidate();

        // Regenerasi token CSRF
        $request->session()->regenerateToken();

        return redirect()->route('auth.index')->with('success', 'Logout Berhasil!');
    }
}
