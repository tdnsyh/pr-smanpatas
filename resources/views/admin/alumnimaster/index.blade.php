@extends('layouts.admin')
@section('title', 'Alumni Master')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="fw-semibold mb-3">@yield('title')</h2>
            <a href="{{ route('admin.alumnimaster.create') }}" class="btn btn-primary">Tambah Alumni</a>
            <a href="{{ route('admin.alumnimaster.import') }}" class="btn btn-success">Import Alumni</a>
            <a href="{{ route('admin.alumnimaster.export') }}" class="btn btn-warning">Export Alumni</a>

            <form method="GET" class="row g-2 mt-3">
                <div class="col-auto">
                    <select name="tahun_kelulusan" class="form-select">
                        <option value="">-- Pilih Tahun Kelulusan --</option>
                        @foreach ($tahunList as $t)
                            <option value="{{ $t }}" {{ $tahun == $t ? 'selected' : '' }}>
                                {{ $t }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('admin.alumnimaster.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </form>
            <div class="table-responsive mt-3">
                <table class="table" id="table1">
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

@push('script')
    <script src="{{ asset('assets/extensions/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.js') }}"></script>
@endpush

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/table-datatable-jquery.css') }}">
@endpush
