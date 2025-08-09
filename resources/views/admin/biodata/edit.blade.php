@extends('layouts.admin')
@section('title', 'Edit Biodata')

@section('content')
    <div class="card">
        <div class="card-body">
            <h1 class="mb-3">Update Biodata</h1>

            <form action="{{ route('admin.biodata.update', $alumni->id) }}" method="POST">
                @csrf
                @method('PUT')

                @include('partials.form.alumni')

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/js/custom.js') }}"></script>
@endpush
