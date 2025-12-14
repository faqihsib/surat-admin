<?php

namespace App\Http\Controllers;

use App\Models\User; // Pastikan menggunakan huruf kapital
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['dataUser'] = User::all();
        return view('pages.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:superadmin,staff,guest',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except(['password', 'foto_profil']);
        $data['password'] = Hash::make($request->password);

        if ($request->hasFile('foto_profil')) {
            $file = $request->file('foto_profil');
            // Nama file unik: time + nama asli
            $filename = time() . '-' . $file->getClientOriginalName();
            // Simpan ke folder public/uploads/profile
            $file->move(public_path('uploads/profile'), $filename);

            $data['foto_profil'] = $filename;
        }

        User::create($data); // Pastikan ini User dengan huruf kapital

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('pages.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['dataUser'] = User::findOrFail($id); // Pastikan ini User dengan huruf kapital
        return view('pages.user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id); // Pastikan ini User dengan huruf kapital

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6|confirmed',
            'role' => 'required|in:superadmin,staff,guest',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except(['password', 'foto_profil']);

        // $user->name = $request->name;
        // $user->email = $request->email;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        if ($request->hasFile('foto_profil')) {
            $file = $request->file('foto_profil');
            $filename = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path('uploads/profile'), $filename);

            // Hapus foto lama jika ada
            if ($user->foto_profil && File::exists(public_path('uploads/profile/' . $user->foto_profil))) {
                File::delete(public_path('uploads/profile/' . $user->foto_profil));
            }

            $data['foto_profil'] = $filename;
        }

        $user->update($data);

        // $user->save();
        return redirect()->route('users.index')->with('success', 'User berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id); // Pastikan ini User dengan huruf kapital
        if ($user->foto_profil && File::exists(public_path('uploads/profile/' . $user->foto_profil))) {
            File::delete(public_path('uploads/profile/' . $user->foto_profil));
        }
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus!');
    }

    public function deleteFoto($id)
    {
        $user = User::findOrFail($id);

        // Hapus file fisik jika ada
        if ($user->foto_profil && File::exists(public_path('uploads/profile/' . $user->foto_profil))) {
            File::delete(public_path('uploads/profile/' . $user->foto_profil));
        }

        // Set kolom database jadi NULL
        $user->foto_profil = null;
        $user->save();

        return back()->with('success', 'Foto profil berhasil dihapus.');
    }
}
