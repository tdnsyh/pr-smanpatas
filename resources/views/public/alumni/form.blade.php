@extends('layouts.web')
@section('title', 'Cek data alumni')

@section('content')
    <div class="container py-5">
        <form method="POST" action="{{ route('alumni.simpan') }}">
            @csrf

            @include('partials.form.alumni')
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
@endsection
