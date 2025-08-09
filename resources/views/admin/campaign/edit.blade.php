@extends('layouts.admin')
@section('title', 'Edit Campaign')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="fw-semibold mb-3">@yield('title')</h2>
            <form id="formUpdateCampaign" action="{{ route('admin.campaign.update', $campaign->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf @method('PUT')

                @include('partials.form.campaign')

                <button type="submit" class="btn btn-success">Update</button>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const quill = new Quill('#editor', {
                theme: 'snow'
            });

            const initialContent = {!! json_encode(old('deskripsi', $campaign->deskripsi)) !!};
            quill.root.innerHTML = initialContent;

            const form = document.getElementById('formUpdateCampaign');
            form.addEventListener('submit', function() {
                const hiddenInput = document.getElementById('deskripsi');
                console.log('Quill content before submit:', quill.root.innerHTML);
                hiddenInput.value = quill.root.innerHTML;
            });
        });
    </script>
@endpush
