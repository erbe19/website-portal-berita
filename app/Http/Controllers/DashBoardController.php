<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Berita;

class DashBoardController extends Controller{
    public function index()
    {
        $totalBerita = Berita::count();
        $totalKategori = Kategori::count();
        $totalUser = User::count();

        $latestBerita = Berita::with('kategori')->latest()->get()->take(5);
        return view('backend.content.dashboard',compact('totalBerita','totalKategori','totalUser','latestBerita'));
    }

    public function profile()
    {
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
    }
    $id = Auth::id();
    $user = User::findOrFail($id);

    return view('backend.content.profile', compact('user'));
    }


    public function resetPassword()
    {
        return view('backend.content.resetPassword');
    }

    public function prosesResetPassword(Request $request)
    {

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'c_new_password' => 'required_with:new_password|same:new_password|min:6',
        ], [
            'old_password.required' => 'Password lama wajib diisi.',
            'new_password.required' => 'Password baru wajib diisi.',
            'new_password.min' => 'Password baru harus minimal 6 karakter.',
            'c_new_password.required_with' => 'Konfirmasi password baru wajib diisi.',
            'c_new_password.same' => 'Konfirmasi password harus sama dengan password baru.',
        ]);


        $user = User::findOrFail(Auth::id());


        if (Hash::check($request->old_password, $user->password)) {

            $user->password = Hash::make($request->new_password);

            try {
                $user->save();
                return redirect()->route('dashboard.resetPassword')
                    ->with('success', 'Selamat! Anda berhasil mengubah password.');
            } catch (\Exception $e) {
                return redirect()->route('dashboard.resetPassword')
                    ->with('error', 'Terjadi kesalahan saat menyimpan password baru.');
            }
        } else {
            return redirect()->route('dashboard.resetPassword')
                ->with('error', 'Password lama yang Anda masukkan salah.');
        }
    }
}

