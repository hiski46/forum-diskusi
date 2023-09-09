<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\ResetPasswordEmail;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

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
            if ($request->file('foto')) {
                $foto = $request->file('foto');
                $new_foto_name = uniqid() . '.' . $foto->extension();
                $foto->storeAs('foto_profil', $new_foto_name, ['disk' => 'public']);
            } else {
                return back()->withErrors([
                    'foto' => 'Foto gagal di upload.',
                ])->onlyInput();
            }
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

        if ($request->has('foto')) {
            if ($request->file('foto')) {
                $foto = $request->file('foto');
                $new_foto_name = uniqid() . '.' . $foto->extension();
                $foto->storeAs('foto_profil', $new_foto_name, ['disk' => 'public']);
            } else {
                return back()->withErrors([
                    'foto' => 'Foto gagal di upload.',
                ])->onlyInput();
            }
        }

        $user = User::find($id);
        $user->email = $request->input('email');
        $user->name = $request->input('name');
        $user->syncRoles([$request->input('role')]);
        if (isset($new_foto_name)) {
            $user->foto = $new_foto_name;
        }
        $update = $user->save();

        if ($update) {
            return redirect('/pegawai')->with('success', 'Berhasil mengubah data pegawai');
        }
    }

    public function delete($id)
    {
        $user = $user = User::find($id);
        if ($user->delete()) {
            return redirect('/pegawai')->with('success', 'Berhasil menghapus pegawai');
        }
    }

    public function resetPassword($id)
    {
        $user = User::find($id);
        // $user->password = Hash::make('forum_diskusi');
        $new_pass = substr(md5(mt_rand()), 0, 8);

        try {
            $user->notify(new ResetPasswordEmail($user, $new_pass));
            $user->password = Hash::make($new_pass);
            $user->save();
            return redirect('/pegawai')->with('success', 'Berhasil mereset password. Password Baru dikirim melauli email');
        } catch (\Throwable $th) {
            return redirect('/pegawai')->with('errors', 'Gagal mengirim email. ' . $th->getMessage());
        }
    }

    public function halamanSelfEdit()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $data['user'] = $user;
        return view('menu.self_edit', $data);
    }

    public function selfEdit(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'new_password' => 'nullable|min:8'
        ]);

        if ($request->has('foto')) {
            if ($request->file('foto')) {
                $foto = $request->file('foto');
                $new_foto_name = uniqid() . '.' . $foto->extension();
                $foto->storeAs('foto_profil', $new_foto_name, ['disk' => 'public']);
            } else {
                return back()->withErrors([
                    'foto' => 'Foto gagal di upload.',
                ])->onlyInput();
            }
        }

        $user->email = $request->input('email');
        $user->name = $request->input('name');
        if (isset($new_foto_name)) {
            $user->foto = $new_foto_name;
        }
        if ($request->input('new_password')) {
            $user->password = Hash::make($request->input('new_password'));
        }
        $update = $user->save();

        if ($update) {
            return redirect('/pegawai')->with('success', 'Berhasil mengubah Profil');
        }
    }
}
