@extends('layouts.admin')
@section('title', 'Edit Pemasukan')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="fw-semibold mb-3">@yield('title')</h2>
            <form action="{{ route('admin.pemasukan.update', $pemasukan->id) }}" method="POST">
                @csrf
                @method('PUT')

                @include('partials.form.pemasukan')

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('admin.pemasukan.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection
