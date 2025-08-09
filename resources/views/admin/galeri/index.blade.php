@extends('layouts.admin')
@section('title', 'Galeri')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="fw-semibold mb-3">@yield('title')</h2>
            <a href="{{ route('admin.galeri.create') }}" class="btn btn-primary mb-3">Tambah Galeri</a>
            @if ($galeriList->isEmpty())
                <div class="alert alert-warning" role="alert">
                    Belum ada galeri yang ditambahkan.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead class="table-dark border-0">
                            <tr>
                                <th class="rounded-start">No</th>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th>Tanggal</th>
                                <th>Jumlah Foto</th>
                                <th class="rounded-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($galeriList as $index => $galeri)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $galeri->judul }}</td>
                                    <td>{{ Str::limit($galeri->deskripsi, 60) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($galeri->tanggal)->format('d M Y') }}</td>
                                    <td>{{ $galeri->galeriFoto->count() }} foto</td>
                                    <td>
                                        <a href="{{ route('admin.galeri.show', $galeri) }}"
                                            class="btn btn-sm btn-info">Detail</a>
                                        <a href="{{ route('admin.galeri.edit', $galeri) }}"
                                            class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('admin.galeri.destroy', $galeri) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Belum ada galeri.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            @endif

        </div>
    </div>
@endsection
