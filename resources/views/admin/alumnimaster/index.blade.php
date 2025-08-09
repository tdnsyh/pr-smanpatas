@extends('layouts.admin')
@section('title', 'Alumni Master')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="fw-semibold mb-3">@yield('title')</h2>
            <a href="{{ route('admin.alumnimaster.create') }}" class="btn btn-primary mb-3">Tambah Alumni</a>

            <div class="table-responsive">
                <table class="table">
                    <thead class="table-dark border-0">
                        <tr>
                            <th class="rounded-start">Nama Lengkap</th>
                            <th>Tahun Kelulusan</th>
                            <th>Tanggal Lahir</th>
                            <th class="rounded-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alumnis as $alumni)
                            <tr>
                                <td>{{ $alumni->nama_lengkap }}</td>
                                <td>{{ $alumni->tahun_kelulusan }}</td>
                                <td>{{ $alumni->tanggal_lahir->format('d-m-Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.alumnimaster.edit', $alumni->id) }}"
                                        class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('admin.alumnimaster.destroy', $alumni->id) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Hapus data ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
