@extends('layouts.admin')
@section('title', 'Berita')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="fw-semibold mb-3">@yield('title')</h2>
            <a href="{{ route('admin.berita.create') }}" class="btn btn-primary mb-3">Tambah Berita</a>
            @if ($beritas->isEmpty())
                <div class="alert alert-warning" role="alert">
                    Belum ada berita yang dipublikasi.
                </div>
            @else
                <div class="row row-cols-1 row-cols-md-4 g-3">
                    @foreach ($beritas as $berita)
                        <div class="col">
                            <div class="card h-100 shadow-none border d-flex flex-column">
                                <div class="card-body d-flex flex-column p-3">
                                    <div class="ratio ratio-16x9">
                                        <img src="{{ asset('storage/' . $berita->gambar) }}"
                                            class="img-fluid rounded-top object-fit-cover" alt="{{ $berita->judul }}">
                                    </div>
                                    <h5 class="mt-3">{{ $berita->judul }}</h5>
                                    <p>Penulis: {{ $berita->penulis }}</p>

                                    <div class="mt-auto gap-2">
                                        <a href="{{ route('admin.berita.edit', $berita->slug) }}"
                                            class="btn btn-warning btn-sm" title="Edit">
                                            <i class="ti ti-pencil"></i>
                                        </a>

                                        <button type="button" class="btn btn-danger btn-sm" title="Hapus"
                                            data-bs-toggle="modal" data-bs-target="#modalHapus{{ $berita->id }}">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="modalHapus{{ $berita->id }}" tabindex="-1"
                                aria-labelledby="modalHapusLabel{{ $berita->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalHapusLabel{{ $berita->id }}">Konfirmasi
                                                Hapus</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Tutup"></button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin menghapus berita ini?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                            <form action="{{ route('admin.berita.destroy', $berita->slug) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{ $beritas->links() }}
            @endif
        </div>
    </div>
@endsection
