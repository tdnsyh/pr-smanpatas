@extends('layouts.admin')
@section('title', 'Tambah Alumni Master')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="fw-semibold mb-3">@yield('title')</h2>
            <form action="{{ route('admin.alumni.master.store') }}" method="POST">
                @include('partials.form.alumnimaster')
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.alumni.master.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
@endsection
