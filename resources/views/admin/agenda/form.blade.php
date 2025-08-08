@extends('layouts.admin')
@section('title', 'Agenda')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="fw-semibold mb-3">{{ isset($agenda) ? 'Edit Agenda' : 'Tambah Agenda' }}</h2>

            <form method="POST"
                action="{{ isset($agenda) ? route('admin.agenda.update', $agenda) : route('admin.agenda.store') }}"
                enctype="multipart/form-data" id="formCampaign">
                @csrf
                @if (isset($agenda))
                    @method('PUT')
                @endif

                @include('partials.form.agenda')
                <button class="btn btn-success">{{ isset($agenda) ? 'Update' : 'Simpan' }}</button>
                <a href="{{ route('admin.agenda.index') }}" class="btn btn-secondary">Kembali</a>
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
