@extends('layouts.admin')
@section('title', 'Tambah Berita')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="fw-semibold mb-3">@yield('title')</h2>
            <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data" id="formCampaign">
                @csrf
                @include('partials.form.berita')
                <button class="btn btn-success mt-2">Simpan</button>
            </form>
        </div>
    </div>
@endsection
