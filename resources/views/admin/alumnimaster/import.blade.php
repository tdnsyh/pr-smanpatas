@extends('layouts.admin')
@section('title', 'Import Master Alumni')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="fw-semibold mb-4">@yield('title')</h2>
            <form action="{{ route('admin.alumnimaster.import.save') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="form-control mb-3" accept=".xlsx,.csv" required>
                <button type="submit" class="btn btn-success">Import</button>
            </form>
        </div>
    </div>
@endsection
