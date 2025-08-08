@extends('layouts.admin')
@section('title', 'Edit Alumni Master')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="fw-semibold mb-3">@yield('title')</h2>
            <form action="{{ route('admin.alumni.master.update', $alumni->id) }}" method="POST">
                @csrf
                @method('PUT')
                @include('partials.form.alumnimaster')
                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('admin.alumni.master.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
@endsection
