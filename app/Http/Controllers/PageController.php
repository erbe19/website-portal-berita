<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
    public function index()
    {
        $page = Page::all();
        return view('backend.content.page.list', compact('page'));
    }

    public function tambah()
    {
        return view('backend.content.page.formTambah');
    }

    public function prosesTambah(Request $request)
{
    $request->validate([
        'judul_page' => 'required|max:255',
        'isi_page' => 'required',
    ]);

    $page = new Page();
    $page->judul_page = $request->judul_page;
    $page->isi_page = $request->isi_page;
    $page->status_page = $request->input('status_page', 1);

    try {
        $page->save();
        return redirect(route('page.index'))->with('pesan', ['success', 'Berhasil menambahkan page!']);
    } catch (\Exception $e) {
        return redirect(route('page.index'))->with('pesan', ['danger', 'Gagal menambahkan page!']);
    }
}



    public function ubah($id_page)
    {
        $page = Page::findOrFail($id_page);
        return view('backend.content.page.formUbah', compact('page'));
    }

    public function prosesUbah(Request $request, $id_page)
{
    $this->validate($request, [
        'judul_page' => 'required',
        'isi_page' => 'required',
        'status_page' => 'required',
    ]);

    $page = Page::findOrFail($id_page);
    $page->judul_page = $request->judul_page;
    $page->isi_page = $request->isi_page;
    $page->status_page = $request->status_page;

    try {
        $page->save();
        return redirect(route('page.index'))->with('pesan', ['success', 'Berhasil mengubah page!']);
    } catch (\Exception $e) {
        return redirect(route('page.index'))->with('pesan', ['danger', 'Gagal mengubah page!']);
    }
}




    public function hapus($id_page)
    {
        $page = Page::findOrFail($id_page);

        try {
            $page->delete();
            return redirect(route('page.index'))->with('pesan', ['success', 'Berhasil menghapus page!']);
        } catch (\Exception $e) {
            return redirect(route('page.index'))->with('pesan', ['danger', 'Gagal menghapus page!']);
        }
    }
}
