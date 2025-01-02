@extends('frontend.layout.main')

@section('content')
<section class="py-5">
    <div class="container px-5">
        <h2 class="fw-bolder fs-5 mb-4">Semua Berita</h2>
        <div class="row gx-5">
            @forelse ($berita as $row)
                <div class="col-lg-4 mb-5">
                    <div class="card h-100 shadow border-0">
                        <img class="card-img-top" src="{{ asset('storage/' . $row->gambar_berita) }}" alt="{{ $row->judul_berita }}">
                        <div class="card-body p-4">
                            <div class="badge bg-primary bg-gradient rounded-pill mb-2">{{ $row->kategori->nama_kategori }}</div>
                            <a class="text-decoration-none link-dark stretched-link" href="{{ route('home.detail.berita', $row->id_berita) }}">
                                <div class="h5 card-title mb-3">{{ $row->judul_berita }}</div>
                            </a>
                            <p class="card-text mb-0">{{ Str::limit(strip_tags($row->isi_berita), 200) }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <p>Tidak ada berita ditemukan.</p>
            @endforelse
        </div>
    </div>
</section>
@endsection
