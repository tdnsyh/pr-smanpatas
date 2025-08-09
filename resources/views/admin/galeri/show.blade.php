@extends('layouts.admin')
@section('title', $galeri->judul ?? '-')

@section('content')
    <div class="card">
        <div class="card-body">
            <h3 class="fw-semibold mb-3">{{ $galeri->judul ?? '-' }}</h3>
            <div class="mb-4">
                <p>{{ $galeri->deskripsi }}</p>
                <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($galeri->tanggal)->format('d M Y') }}</p>
            </div>

            @if ($galeri->galeriFoto->count() > 0)
                <div class="row row-cols-2 row-cols-md-4 g-3" data-masonry='{"percentPosition": true }'>
                    @foreach ($galeri->galeriFoto as $foto)
                        <div class="col">
                            <img src="{{ asset('storage/' . $foto->gambar) }}" class="img-fluid rounded" alt="Foto Galeri">
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-info">Belum ada foto di galeri ini.</div>
            @endif
            <a href="{{ route('admin.galeri.index') }}" class="btn btn-outline-dark mt-3">Kembali ke daftar</a>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elem = document.querySelector('.row');
            new Masonry(elem, {
                itemSelector: '.col',
                percentPosition: true
            });
        });
    </script>
@endpush
