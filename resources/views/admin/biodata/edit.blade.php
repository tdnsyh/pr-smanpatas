@extends('layouts.admin')
@section('title', 'Edit Biodata')

@section('content')
    <div class="card">
        <div class="card-body">
            <h1 class="mb-3">Update Biodata</h1>

            <form action="{{ route('admin.biodata.update', $alumni->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row row-cols-1 row-cols-md-2 g-4">
                    <div class="col-md-4">
                        @if ($alumni->avatar)
                            <img src="{{ asset('storage/' . $alumni->avatar) }}" alt="Avatar"
                                class="rounded object-fit-cover img-fluid mb-3">
                        @endif
                        <div class="mb-">
                            <label class="form-label">Avatar (opsional)</label><br>
                            <input type="file" name="avatar" class="form-control">
                            <input class="form-check-input" type="checkbox" name="privasi[email]" value="1"
                                {{ old('privasi.email', $privasi['email'] ?? false) ? 'checked' : '' }}>
                            <label class="form-check-label">Tampilkan ke publik</label>
                        </div>
                    </div>
                    <div class="col-md-8">
                        @include('partials.form.alumni')
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/js/custom.js') }}"></script>
@endpush
