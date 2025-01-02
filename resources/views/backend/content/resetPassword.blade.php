@extends('backend.layout.main')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Reset Password</h1>

    {{-- Pesan Sukses atau Error --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('dashboard.prosesResetPassword') }}" method="post">
                @csrf

                
                <div class="mb-3">
                    <label class="form-label">Password Lama</label>
                    <input type="password" name="old_password"
                        class="form-control @error('old_password') is-invalid @enderror">
                    @error('old_password')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>


                <div class="mb-3">
                    <label class="form-label">Password Baru</label>
                    <input type="password" name="new_password"
                        class="form-control @error('new_password') is-invalid @enderror">
                    @error('new_password')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>


                <div class="mb-3">
                    <label class="form-label">Konfirmasi Password Baru</label>
                    <input type="password" name="c_new_password"
                        class="form-control @error('c_new_password') is-invalid @enderror">
                    @error('c_new_password')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('dashboard.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
