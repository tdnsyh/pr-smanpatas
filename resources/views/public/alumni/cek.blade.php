@extends('layouts.web')
@section('title', 'Cek data alumni')

@section('content')
    @include('partials.navbar')
    <div class="container py-5">
        @if ($errors->any())
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form method="POST" action="{{ route('alumni.cekdata') }}">
            @csrf

            <div class="mb-3">
                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="tahun_kelulusan" class="form-label">Tahun Kelulusan</label>
                <input type="number" name="tahun_kelulusan" class="form-control" required>
            </div>

            {{-- <div class="mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" required>
            </div> --}}

            <button type="submit" class="btn btn-primary">Lanjutkan</button>
        </form>
    </div>
@endsection
