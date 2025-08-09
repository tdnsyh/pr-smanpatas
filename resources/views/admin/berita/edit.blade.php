@extends('layouts.admin')
@section('title', 'Edit Berita')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="fw-semibold mb-3">@yield('title')</h2>
            <form action="{{ route('admin.berita.update', $berita->slug) }}" method="POST" enctype="multipart/form-data"
                id="formCampaign">
                @csrf
                @method('PUT')
                @include('partials.form.berita', ['berita' => $berita])
                <button class="btn btn-success mt-2">Update</button>
            </form>
        </div>
    </div>
@endsection
