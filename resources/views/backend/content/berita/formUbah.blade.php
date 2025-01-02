@extends('backend.layout.main')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Form Ubah Berita</h1>

        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('berita.prosesUbah', $berita->id_berita) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Judul Berita</label>
                        <input type="text" name="judul_berita" value="{{ old('judul_berita', $berita->judul_berita) }}"
                               class="form-control @error('judul_berita') is-invalid @enderror">
                        @error('judul_berita')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select name="id_kategori" class="form-control @error('id_kategori') is-invalid @enderror">
                            @foreach($kategori as $item)
                                <option value="{{ $item->id_kategori }}"
                                    {{ old('id_kategori', $berita->id_kategori) == $item->id_kategori ? 'selected' : '' }}>
                                    {{ $item->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_kategori')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gambar Berita</label>
                        <input type="file" id="gambar_berita" name="gambar_berita" class="form-control @error('gambar_berita') is-invalid @enderror">
                        <p>Gambar saat ini:</p>
                        <img id="currentImage" src="{{ $berita->gambar_berita ? asset('storage/' . $berita->gambar_berita) : '#' }}"
                             alt="Gambar Berita"
                             width="150"
                             onerror="this.style.display='none'">
                        <p id="noImage" class="text-muted" style="{{ $berita->gambar_berita ? 'display: none;' : '' }}">
                            Belum ada gambar.
                        </p>
                        @error('gambar_berita')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>





                    <div class="mb-3">
                        <label class="form-label">Isi Berita</label>
                        <textarea id="editor" name="isi_berita" class="form-control @error('isi_berita') is-invalid @enderror"
                                  rows="5">{{ old('isi_berita', $berita->isi_berita) }}</textarea>
                        @error('isi_berita')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('berita.index') }}" class="btn btn-secondary">Kembali</a>
                </form>

                <script>
                    document.getElementById('gambar_berita').addEventListener('change', function (event) {
                        const file = event.target.files[0];
                        const currentImage = document.getElementById('currentImage');
                        const noImage = document.getElementById('noImage');

                        if (file) {
                            const reader = new FileReader();

                            reader.onload = function (e) {
                                currentImage.src = e.target.result;
                                currentImage.style.display = 'block';
                                noImage.style.display = 'none';
                            };

                            reader.readAsDataURL(file); 
                        } else {
                            currentImage.style.display = 'none';
                            noImage.style.display = 'block';
                        }
                    });
                </script>

                <script>
                    CKEDITOR.replace('editor', {
                        filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
                        filebrowserUploadMethod: 'form'
                    });
                </script>



            </div>
        </div>
    </div>
@endsection
