@extends('layouts.admin')
@section('title', 'Import Alumni')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="fw-semibold mb-4">@yield('title')</h2>
            <form action="{{ route('admin.alumni.preview') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="file" class="form-label">Upload File Excel</label>
                    <input type="file" name="file" class="form-control" required>
                </div>
                <button class="btn btn-primary">Preview</button>
                <a href="{{ asset('template/template_alumni.xlsx') }}" class="btn btn-secondary" download>
                    Unduh Template Excel
                </a>
                <a class="btn btn-outline-primary" href="{{ route('admin.alumni.index') }}">Kembali</a>
            </form>
        </div>
    </div>
@endsection
