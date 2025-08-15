@extends('layouts.admin')
@section('title', 'Tambah pengguna')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="fw-semibold mb-3">@yield('title')</h2>
            <form action="{{ route('admin.pengguna.store') }}" method="POST" class="mt-3">
                @csrf

                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Role</label>
                    <select name="role" class="form-control" required>
                        <option value="">-- Pilih Role --</option>
                        <option value="bendahara">Bendahara</option>
                        <option value="sekretaris">Sekretaris</option>
                        <option value="media">Media</option>
                        <option value="operator">Operator</option>
                        <option value="kehormatan">Kehormatan</option>
                    </select>
                </div>

                <button class="btn btn-success">Simpan</button>
                <a href="{{ route('admin.pengguna.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection
