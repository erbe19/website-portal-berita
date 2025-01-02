@extends('backend.layout.main')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-4">
                <h1 class="h3 mb-2 text-gray-800">List User</h1>
            </div>
            <div class="col-lg-6 text-right">
                <a href="{{ route('user.tambah') }}" class="btn btn-sm btn-primary">
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
                                    <th style="width: 10%;" >No</th>
                                    <th >Nama User</th>
                                    <th >Email User</th>
                                    <th >Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach ($user as $row)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->email }}</td>
                                        <td>
                                            <a href="{{ route('user.ubah', $row->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fa fa-edit"></i> Ubah
                                            </a>
                                            <a href="{{ route('user.hapus', $row->id) }}"
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
