@extends('layouts.admin')
@section('title', 'Pemasukan')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="fw-semibold mb-3">@yield('title')</h2>
            <a href="{{ route('admin.pemasukan.create') }}" class="btn btn-primary mb-3">Tambah Pemasukan</a>
            @if ($pemasukan->isEmpty())
                <div class="alert alert-warning" role="alert">
                    Belum ada data pemasukan.
                </div>
            @else
                <form method="GET" action="{{ route('admin.pemasukan.index') }}" class="row g-3 mb-4">
                    <div class="col-md-3">
                        <label>Dari Tanggal</label>
                        <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                    </div>
                    <div class="col-md-3">
                        <label>Sampai Tanggal</label>
                        <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button class="btn btn-primary me-2" type="submit">Filter</button>
                        <a href="{{ route('admin.pemasukan.index') }}" class="btn btn-secondary">Reset</a>
                    </div>
                </form>

                <div class="alert alert-info">
                    <strong>Total Pemasukan:</strong> Rp {{ number_format($totalPemasukan, 2, ',', '.') }}
                </div>

                {{-- Tabel --}}
                <div class="table-responsive">
                    <table class="table" id="table1">
                        <thead class="table-primary border-0">
                            <tr>
                                <th class="rounded-start">No</th>
                                <th>Tanggal</th>
                                <th>Kategori</th>
                                <th>Sumber</th>
                                <th>Jumlah</th>
                                <th class="rounded-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pemasukan as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                    <td>{{ $item->kategori }}</td>
                                    <td>{{ $item->sumber }}</td>
                                    <td>Rp {{ number_format($item->jumlah, 2, ',', '.') }}</td>
                                    <td>
                                        <a href="{{ route('admin.pemasukan.edit', $item->id) }}"
                                            class="btn btn-sm btn-warning" title="Edit">
                                            <i class="ti ti-pencil"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-danger" title="Hapus"
                                            data-bs-toggle="modal" data-bs-target="#modalHapus{{ $item->id }}">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <!-- Modal Hapus -->
                                <div class="modal fade" id="modalHapus{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="modalHapusLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalHapusLabel{{ $item->id }}">Konfirmasi
                                                    Hapus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Tutup"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus data pemasukan ini?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <form action="{{ route('admin.pemasukan.destroy', $item->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data pemasukan.</td>
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
