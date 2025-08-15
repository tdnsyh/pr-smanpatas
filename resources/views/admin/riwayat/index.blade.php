@extends('layouts.admin')
@section('title', 'Riwayat Donasi Saya')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="fw-semibold mb-3">@yield('title')</h2>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Campaign</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($donasi as $d)
                            <tr>
                                <td>{{ $d->created_at->format('d-m-Y') }}</td>
                                <td>{{ $d->campaign->judul ?? '-' }}</td>
                                <td>Rp {{ number_format($d->jumlah, 0, ',', '.') }}</td>
                                <td>{{ $d->status }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Belum ada riwayat donasi</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
