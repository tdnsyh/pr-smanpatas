@extends('layouts.admin')
@section('title', 'Tambah Campaign')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="fw-semibold mb-3">@yield('title')</h2>

            <form action="{{ route('admin.campaign.store') }}" method="POST" enctype="multipart/form-data" id="formCampaign">
                @csrf

                @include('partials.form.campaign')

                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('admin.campaign.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection

@push('style')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
@endpush

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
@endpush
