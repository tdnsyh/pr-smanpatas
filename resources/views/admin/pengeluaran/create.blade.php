@extends('layouts.admin')
@section('title', 'Tambah pengeluaran')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="fw-semibold mb-3">@yield('title')</h2>
            <form action="{{ route('admin.pengeluaran.store') }}" method="POST">
                @csrf

                @include('partials.form.pengeluaran')

                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('admin.pengeluaran.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection
