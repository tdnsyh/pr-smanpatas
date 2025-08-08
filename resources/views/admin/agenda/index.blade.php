@extends('layouts.admin')
@section('title', 'Data Agenda')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="fw-semibold mb-3">@yield('title')</h2>
            <a href="{{ route('admin.agenda.create') }}" class="btn btn-primary mb-3">Tambah Agenda</a>
            @if ($agendas->isEmpty())
                <div class="alert alert-warning" role="alert">
                    Belum ada data agenda.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead class="table-dark border-0">
                            <tr>
                                <th class="rounded-start">Tanggal</th>
                                <th>Judul</th>
                                <th>Lokasi</th>
                                <th class="rounded-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($agendas as $agenda)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($agenda->tanggal)->format('d M Y') }}</td>
                                    <td>{{ $agenda->judul }}</td>
                                    <td>{{ $agenda->lokasi }}</td>
                                    <td>
                                        <a href="{{ route('admin.agenda.show', $agenda) }}" class="btn btn-info btn-sm"
                                            title="Lihat">
                                            <i class="ti ti-eye"></i>
                                        </a>

                                        <a href="{{ route('admin.agenda.edit', $agenda) }}" class="btn btn-warning btn-sm"
                                            title="Edit">
                                            <i class="ti ti-pencil"></i>
                                        </a>

                                        <button type="button" class="btn btn-danger btn-sm" title="Hapus"
                                            data-bs-toggle="modal" data-bs-target="#modalHapus{{ $agenda->id }}">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </td>
                                    <!-- Modal Konfirmasi Hapus -->
                                    <div class="modal fade" id="modalHapus{{ $agenda->id }}" tabindex="-1"
                                        aria-labelledby="modalHapusLabel{{ $agenda->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalHapusLabel{{ $agenda->id }}">
                                                        Konfirmasi Hapus</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Tutup"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus agenda ini?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <form action="{{ route('admin.agenda.destroy', $agenda) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{ $agendas->links() }}
            @endif
        </div>
    </div>
@endsection
