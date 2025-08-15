@extends('layouts.admin')
@section('title', 'Profil')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="fw-semibold mb-3">@yield('title')</h2>
            <form action="{{ route('profil.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row row-cols-1 row-cols-md-2">
                    <div class="col col-md-5">
                        <div class="ratio ratio-1x1">
                            @if ($user->avatar)
                                <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar"
                                    class="rounded object-fit-cover">
                            @endif
                        </div>
                    </div>
                    <div class="col col-md-7">
                        <div class="mb-3 mt-3 mt-md-0">
                            <label class="form-label">Nama</label>
                            <input type="text" name="name" class="form-control"
                                value="{{ old('name', $user->name) }}">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control"
                                value="{{ old('email', $user->email) }}">
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password Baru (kosongkan jika tidak diubah)</label>
                            <input type="password" name="password" class="form-control">
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Avatar (opsional)</label><br>
                            <input type="file" name="avatar" class="form-control">
                            @error('avatar')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary rounded">Simpan Perubahan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
