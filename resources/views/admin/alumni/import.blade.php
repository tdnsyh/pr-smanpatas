@extends('layouts.admin')
@section('title', 'Import Alumni')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="fw-semibold mb-4">@yield('title')</h2>
            <form action="{{ route('admin.alumni.import.save') }}" method="POST" enctype="multipart/form-data" class="mb-3">
                @csrf
                <div class="mb-3">
                    <label for="file" class="form-label">Upload File Excel/CSV</label>
                    <input type="file" name="file" id="file" class="form-control" accept=".xlsx,.csv" required>
                </div>
                <button type="submit" class="btn btn-primary">Import</button>
            </form>
        </div>
    </div>
@endsection
