<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        return view('backend.content.kategori.list', compact('kategori'));
    }

    public function tambah()
    {
        return view('backend.content.kategori.formTambah');
    }

    public function prosesTambah(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|max:255',
        ]);

        $kategori = new Kategori();
        $kategori->nama_kategori = $request->nama_kategori;

        try {
            $kategori->save();
            return redirect(route('kategori.index'))->with('pesan', ['success', 'Berhasil menambahkan kategori!']);
        } catch (\Exception $e) {
            return redirect(route('kategori.index'))->with('pesan', ['danger', 'Gagal menambahkan kategori!']);
        }
    }

    public function ubah($id_kategori)
    {
        $kategori = Kategori::findOrFail($id_kategori);
        return view('backend.content.kategori.formUbah', compact('kategori'));
    }

    public function prosesUbah(Request $request, $id_kategori)
    {
        $request->validate([
            'nama_kategori' => 'required|max:255',
        ]);

        $kategori = Kategori::findOrFail($id_kategori);
        $kategori->nama_kategori = $request->nama_kategori;

        try {
            $kategori->save();
            return redirect(route('kategori.index'))->with('pesan', ['success', 'Berhasil mengubah kategori!']);
        } catch (\Exception $e) {
            return redirect(route('kategori.index'))->with('pesan', ['danger', 'Gagal mengubah kategori!']);
        }
    }


    public function hapus($id_kategori)
    {
        $kategori = Kategori::findOrFail($id_kategori);

        try {
            $kategori->delete();
            return redirect(route('kategori.index'))->with('pesan', ['success', 'Berhasil menghapus kategori!']);
        } catch (\Exception $e) {
            return redirect(route('kategori.index'))->with('pesan', ['danger', 'Gagal menghapus kategori!']);
        }
    }
}
