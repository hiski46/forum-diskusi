<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class PegawaiController extends Controller
{
    public function index()
    {
        $data['users'] = User::get();
        return view('menu.pegawai', $data);
    }

    public function halamanTambah()
    {
        $data['role'] = Role::where('id', '!=', 3)->get();
        return view('menu.add_pegawai', $data);
    }

    public function tambah(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
        ]);
        $data = $request->except(['_token', 'foto', 'role']);

        if ($request->has('foto')) {
            $foto = $request->file('foto');
            $new_foto_name = uniqid() . '.' . $foto->extension();
            $foto->storeAs('foto_profil', $new_foto_name, ['disk' => 'public']);
        } else {
            return back()->withErrors([
                'foto' => 'Foto gagal di upload.',
            ])->onlyInput();
        }

        $data['foto'] = $new_foto_name ?? null;
        $data['email_verified_at'] = now();
        $data['password'] = Hash::make('forum_diskusi');

        $newUser = User::create($data);
        $role = Role::find($request->input('role'));
        if ($newUser->assignRole($role)) {
            return redirect('/pegawai')->with('success', 'Berhasil mendaftarkan pegawai baru');
        }

        return back()->onlyInput();
    }

    public function halamanEdit($id)
    {

        $data['user'] = User::find($id);
        $data['role'] = Role::where('id', '!=', 3)->get();
        return view('menu.edit_pegawai', $data);
    }

    public function edit(Request $request, $id)
    {
        $validatedData = $request->validate([
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
        ]);
    }
}
