@extends('layouts.admin')
@section('title', 'Alumni')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="fw-semibold mb-3">@yield('title')</h2>
            <a href="{{ route('admin.alumni.create') }}" class="btn btn-primary">Tambah Alumni</a>
            @if ($alumnis->isEmpty())
                <div class="alert alert-warning mt-3" role="alert">
                    Belum ada data alumni.
                </div>
            @else
                <div class="table-responsive mt-3">
                    <table class="table" id="table1">
                        <thead class="table-dark border-0">
                            <tr>
                                <th class="rounded-start">Nama Lengkap</th>
                                <th>NIA</th>
                                <th>Email</th>
                                <th>Nomor WA</th>
                                <th>Tahun Kelulusan</th>
                                <th>Pekerjaan Saat Ini</th>
                                <th>Status</th>
                                <th class="rounded-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($alumnis as $alumni)
                                <tr>
                                    <td>{{ $alumni->nama_lengkap }}</td>
                                    <td>{{ $alumni->nia }}</td>
                                    <td>{{ $alumni->email }}</td>
                                    <td>{{ $alumni->no_wa }}</td>
                                    <td>{{ $alumni->tahun_kelulusan }}</td>
                                    <td>{{ $alumni->status }}</td>
                                    <td>{{ $alumni->pekerjaan_saat_ini }}</td>
                                    <td>
                                        <div class="d-flex no-wrap gap-1">
                                            <a href="{{ route('admin.alumni.show', $alumni) }}" class="btn btn-sm btn-info"
                                                title="Detail">
                                                <i class="ti ti-eye"></i>
                                            </a>

                                            <a href="{{ route('admin.alumni.edit', $alumni) }}"
                                                class="btn btn-sm btn-warning" title="Edit">
                                                <i class="ti ti-edit"></i>
                                            </a>

                                            <button type="button" class="btn btn-sm btn-danger" title="Hapus"
                                                data-bs-toggle="modal" data-bs-target="#modalHapus{{ $alumni->id }}">
                                                <i class="ti ti-trash"></i>
                                            </button>

                                            <div class="modal fade" id="modalHapus{{ $alumni->id }}" tabindex="-1"
                                                aria-labelledby="modalHapusLabel{{ $alumni->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content border-danger">
                                                        <div class="modal-header bg-danger text-white">
                                                            <h5 class="modal-title"
                                                                id="modalHapusLabel{{ $alumni->id }}">Konfirmasi Hapus
                                                            </h5>
                                                            <button type="button" class="btn-close btn-close-white"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah Anda yakin ingin menghapus data alumni ini?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Batal</button>
                                                            <form method="POST"
                                                                action="{{ route('admin.alumni.destroy', $alumni) }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">Ya,
                                                                    Hapus</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Belum ada data alumni.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            @endif
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
