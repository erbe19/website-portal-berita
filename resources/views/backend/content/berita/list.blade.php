@extends('backend.layout.main')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-4">
                <h1 class="h3 mb-2 text-gray-800">List Berita</h1>
            </div>
            <div class="col-lg-6 text-right">
                <a href="{{ route('berita.tambah') }}" class="btn btn-sm btn-primary">
                    <i class="fa fa-plus"></i> Tambah
                </a>
            </div>

            @if(session()->has('pesan'))
                <div class="alert alert-{{ session('pesan')[0] }}">
                    {{ session('pesan')[1] }}
                </div>
            @endif

            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" style="width: 100%; table-layout: fixed;" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width: 10%;">No</th>
                                    <th>Gambar Berita</th>
                                    <th>Judul Berita</th>
                                    <th>Kategori</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach ($berita as $row)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>
                                            <img src="{{ asset('storage/' . $row->gambar_berita) }}"
                                                 width="75px" height="75px" alt="Gambar Berita">
                                        </td>
                                        <td>{{ $row->judul_berita }}</td>
                                        <td>{{ $row->kategori->nama_kategori }}</td>
                                        <td>
                                            <a href="{{ route('berita.ubah', $row->id_berita) }}"
                                               class="btn btn-sm btn-primary">
                                                <i class="fa fa-edit"></i> Ubah
                                            </a>
                                            <a href="{{ route('berita.hapus', $row->id_berita) }}"
                                               onclick="return confirm('Anda yakin ingin menghapus?')"
                                               class="btn btn-sm btn-danger">
                                                <i class="fa fa-trash"></i> Hapus
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection