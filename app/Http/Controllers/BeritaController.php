<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;


class BeritaController extends Controller
{
    public function index() {
        $berita = Berita::with('kategori')->get();
        return view('backend.content.berita.list', compact('berita'));
    }


    public function tambah(){
        $kategori = Kategori::all();
        return view('backend.content.berita.formTambah',compact('kategori'));
    }

    public function prosesTambah(Request $request)
{
    
    $request->validate([
        'judul_berita' => 'required',
        'isi_berita' => 'required',
        'id_kategori' => 'required|exists:kategori,id_kategori',
        'gambar_berita' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);


    $gambarPath = $request->file('gambar_berita')->store('uploads', 'public');


    $berita = new Berita();
    $berita->judul_berita = $request->judul_berita;
    $berita->isi_berita = $request->isi_berita;
    $berita->id_kategori = $request->id_kategori;
    $berita->gambar_berita = $gambarPath;

    try {
        $berita->save();
        return redirect(route('berita.index'))->with('pesan', ['success', 'Berhasil tambah berita']);
    } catch (\Exception $e) {
        return redirect(route('berita.index'))->with('pesan', ['danger', 'Gagal tambah berita: ' . $e->getMessage()]);
    }
}


    public function ubah($id){
        $berita =Berita::findOrFail($id);
        $kategori = Kategori::all();
        return view('backend.content.berita.formUbah',compact('berita','kategori'));
    }

    public function prosesUbah(Request $request, $id)
{
    $this->validate($request, [
        'judul_berita' => 'required',
        'isi_berita' => 'required',
        'id_kategori' => 'required',
        'gambar_berita' => 'nullable|image|max:2048',
    ]);

    $berita = Berita::findOrFail($id);
    $berita->judul_berita = $request->judul_berita;
    $berita->isi_berita = $request->isi_berita;
    $berita->id_kategori = $request->id_kategori;

    if ($request->hasFile('gambar_berita')) {
        if ($berita->gambar_berita && Storage::exists('public/' . $berita->gambar_berita)) {
            Storage::delete('public/' . $berita->gambar_berita);
        }

        $path = $request->file('gambar_berita')->store('public/uploads');
        $berita->gambar_berita = str_replace('public/', '', $path);
    }

    $berita->save();

    return redirect()->route('berita.index')->with('pesan', ['success', 'Berita berhasil diubah.']);
}




    public function hapus($id){
        $berita =Berita::findOrFail($id);

        try {
            $berita->delete();
            return redirect(route('berita.index'))->with('pesan', ['success', 'Berhasil hapus berita']);
        } catch (\Exception $e) {
            return redirect(route('berita.index'))->with('pesan', ['danger', 'Gagal hapus berita: ' . $e->getMessage()]);
        }
    }

}
