@extends('layouts.admin')
@section('title', 'Edit Galeri')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="fw-semibold mb-3">@yield('title')</h2>
            <form method="POST" action="{{ route('admin.galeri.update', $galeri) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="judul" class="form-label">Judul Galeri</label>
                    <input type="text" name="judul" class="form-control" value="{{ $galeri->judul }}" required>
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="3">{{ $galeri->deskripsi }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal Dokumentasi</label>
                    <input type="date" name="tanggal" class="form-control" value="{{ $galeri->tanggal }}" required>
                </div>

                <div class="mb-3">
                    <label for="gambar" class="form-label">Tambah Gambar Baru</label>
                    <input type="file" name="gambar[]" class="form-control" accept="image/*" multiple>
                </div>

                <button type="submit" class="btn btn-warning">Perbarui Galeri</button>
            </form>

            <hr>
            <h5>Gambar Sebelumnya</h5>
            <div class="row">
                @foreach ($galeri->galeriFoto as $foto)
                    <div class="col-md-3 mb-3">
                        <img src="{{ asset('storage/' . $foto->gambar) }}" class="img-fluid rounded" alt="foto">
                        <form action="{{ route('admin.galeri.hapus', $foto->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger w-100 mt-2">Hapus</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
