@extends('layouts.admin')
@section('title', $agenda->judul)

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="fw-semibold mb-3">@yield('title')</h2>

            <p class="mb-0 mt-3"><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($agenda->tanggal)->format('d M Y') }}</p>
            <p class="mb-0"><strong>Lokasi:</strong> {{ $agenda->lokasi }}</p>
            <p class="mb-0"><strong>Deskripsi Singkat:</strong> {{ $agenda->deskripsi_pendek }}</p>
            <hr>
            <div>{!! $agenda->deskripsi !!}</div>
        </div>
    </div>
@endsection
