@extends('layouts.admin')
@section('title', 'Tambah Alumni')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="fw-semibold mb-4">@yield('title')</h2>
            <form method="POST" action="{{ route('admin.alumni.store') }}">
                @csrf

                @include('partials.form.alumni', ['alumni' => null, 'privasi' => []])

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.alumni.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection
