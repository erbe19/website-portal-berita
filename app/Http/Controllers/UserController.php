<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return view('backend.content.user.list', compact('user'));
    }

    public function tambah()
    {
        return view('backend.content.user.formTambah');
    }

    public function prosesTambah(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt('12345678');

        try {
            $user->save();
            return redirect(route('user.index'))->with('pesan', ['success', 'Berhasil menambahkan User!']);
        } catch (\Exception $e) {
            return redirect(route('user.index'))->with('pesan', ['danger', 'Gagal menambahkan User!']);
        }
    }

    public function ubah($id)
    {
        $user = User::findOrFail($id);
        return view('backend.content.user.formUbah', compact('user'));
    }

    public function prosesUbah(Request $request, $id)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'email' => 'required',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;

        try {
            $user->save();
            return redirect(route('user.index'))->with('pesan', ['success', 'Berhasil mengubah User!']);
        } catch (\Exception $e) {
            return redirect(route('user.index'))->with('pesan', ['danger', 'Gagal mengubah User!']);
        }
    }


    public function hapus($id)
    {
        $user = User::findOrFail($id);

        try {
            $user->delete();
            return redirect(route('user.index'))->with('pesan', ['success', 'Berhasil menghapus User!']);
        } catch (\Exception $e) {
            return redirect(route('user.index'))->with('pesan', ['danger', 'Gagal menghapus User!']);
        }
    }
}
