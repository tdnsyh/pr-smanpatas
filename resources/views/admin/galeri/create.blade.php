@extends('layouts.admin')
@section('title', 'Tambah Galeri')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="fw-semibold mb-3">@yield('title')</h2>
            <form method="POST" action="{{ route('admin.galeri.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="judul" class="form-label">Judul Galeri</label>
                    <input type="text" name="judul" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal Dokumentasi</label>
                    <input type="date" name="tanggal" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="gambar" class="form-label">Upload Gambar</label>
                    <input type="file" id="gambar" name="gambar[]" class="form-control" accept="image/*" multiple
                        required>
                    <small class="text-muted">Bisa pilih beberapa gambar sekaligus</small>

                    <div id="preview-container" class="mt-3 d-flex flex-wrap gap-2"></div>
                </div>

                <button type="submit" class="btn btn-success">Simpan Galeri</button>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/js/custom.js') }}"></script>
@endpush
