@extends('layouts.admin')
@section('title', 'Campaign')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="fw-semibold mb-3">@yield('title')</h2>
            <a href="{{ route('admin.campaign.create') }}" class="btn btn-primary mb-3">Tambah Campaign</a>
            @if ($campaigns->isEmpty())
                <div class="alert alert-warning" role="alert">
                    Belum ada data campaign.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead class="table-dark border-0">
                            <tr>
                                <th class="rounded-start">Judul</th>
                                <th>Target Donasi</th>
                                <th>Donasi Masuk</th>
                                <th>Status</th>
                                <th class="rounded-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($campaigns as $c)
                                <tr>
                                    <td>{{ $c->judul }}</td>
                                    <td>Rp {{ number_format($c->target_donasi, 0, ',', '.') }}</td>
                                    <td>Rp. {{ number_format($c->total_verified_donasi, 0, ',', '.') }}</td>
                                    <td>
                                        <span
                                            class="badge rounded-pill
                                                @if ($c->status == 'Aktif') text-bg-success
                                                @elseif($c->status == 'Tidak Aktif') text-bg-danger
                                                @elseif($c->status == 'Selesai') text-bg-primary @endif">
                                            {{ $c->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('admin.campaign.edit', $c->id) }}"
                                                class="btn btn-sm btn-warning" title="Edit">
                                                <i class="ti ti-pencil"></i>
                                            </a>

                                            <a href="{{ route('admin.campaign.show', $c->id) }}"
                                                class="btn btn-sm btn-info text-white" title="Detail">
                                                <i class="ti ti-eye"></i>
                                            </a>

                                            <button type="button" class="btn btn-sm btn-danger" title="Hapus"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalHapusDonasi{{ $c->id }}">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade" id="modalHapusDonasi{{ $c->id }}" tabindex="-1"
                                    aria-labelledby="modalHapusDonasiLabel{{ $c->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalHapusDonasiLabel{{ $c->id }}">
                                                    Konfirmasi Hapus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Tutup"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus data donasi ini?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <form action="{{ route('admin.campaign.destroy', $c->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection
