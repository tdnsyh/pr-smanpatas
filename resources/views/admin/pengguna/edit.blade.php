@extends('layouts.admin')
@section('title', 'Edit pengguna')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="fw-semibold mb-3">@yield('title')</h2>
            <form action="{{ route('admin.pengguna.update', $user->id) }}" method="POST" class="mt-3">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                </div>

                <div class="mb-3">
                    <label>Role</label>
                    <select name="role" class="form-control" required>
                        <option value="bendahara" {{ $user->role === 'bendahara' ? 'selected' : '' }}>Bendahara</option>
                        <option value="sekretaris" {{ $user->role === 'sekretaris' ? 'selected' : '' }}>Sekretaris</option>
                        <option value="media" {{ $user->role === 'media' ? 'selected' : '' }}>Media</option>
                        <option value="operator" {{ $user->role === 'operator' ? 'selected' : '' }}>Operator</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Password Baru <small>(Kosongkan jika tidak ingin diubah)</small></label>
                    <input type="password" name="password" class="form-control">
                </div>
                <button class="btn btn-primary">Update</button>
                <a href="{{ route('admin.pengguna.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection
