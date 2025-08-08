@extends('layouts.admin')
@section('title', 'Edit Alumni')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="fw-semibold mb-4">@yield('title')</h2>
            <form method="POST" action="{{ route('admin.alumni.update', $alumni) }}">
                @csrf
                @method('PUT')

                @include('partials.form.alumni', ['alumni' => $alumni, 'privasi' => $privasi])

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('admin.alumni.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection
