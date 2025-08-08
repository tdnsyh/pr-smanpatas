@extends('layouts.admin')
@section('title', 'Detail Alumni')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="fw-semibold mb-4">@yield('title')</h2>
            <dl class="row">
                <dt class="col-sm-4">Nama Lengkap</dt>
                <dd class="col-sm-8">{{ $alumni->nama_lengkap }}</dd>

                <dt class="col-sm-4">Nama Panggilan</dt>
                <dd class="col-sm-8">{{ $alumni->nama_panggilan ?? '-' }}</dd>

                <dt class="col-sm-4">Tahun Kelulusan</dt>
                <dd class="col-sm-8">{{ $alumni->tahun_kelulusan ?? '-' }}</dd>

                <dt class="col-sm-4">Email</dt>
                <dd class="col-sm-8">
                    {{ $alumni->email ?? '-' }}
                </dd>

                <dt class="col-sm-4">Nomor WA</dt>
                <dd class="col-sm-8">
                    {{ $alumni->no_wa ?? '-' }}
                </dd>

                <dt class="col-sm-4">Alamat Saat Ini</dt>
                <dd class="col-sm-8">
                    {{ $alumni->alamat_saat_ini ?? '-' }}
                </dd>

                <dt class="col-sm-4">Jenjang Pendidikan Terakhir</dt>
                <dd class="col-sm-8">{{ $alumni->jenjang_pendidikan_terakhir ?? '-' }}</dd>

                <dt class="col-sm-4">Nama Institusi Pendidikan Terakhir</dt>
                <dd class="col-sm-8">{{ $alumni->nama_institusi_pendidikan_terakhir ?? '-' }}</dd>

                <dt class="col-sm-4">Program Studi / Jurusan</dt>
                <dd class="col-sm-8">{{ $alumni->program_studi ?? '-' }}</dd>

                <dt class="col-sm-4">Pekerjaan Saat Ini</dt>
                <dd class="col-sm-8">
                    {{ $alumni->pekerjaan_saat_ini ?? '-' }}
                </dd>

                <dt class="col-sm-4">Nama Instansi / Perusahaan</dt>
                <dd class="col-sm-8">{{ $alumni->nama_instansi ?? '-' }}</dd>

                <dt class="col-sm-4">Jabatan / Posisi</dt>
                <dd class="col-sm-8">{{ $alumni->jabatan ?? '-' }}</dd>

                <dt class="col-sm-4">Lokasi Tempat Bekerja</dt>
                <dd class="col-sm-8">{{ $alumni->lokasi_tempat_bekerja ?? '-' }}</dd>
            </dl>

            <a href="{{ route('admin.alumni.index') }}" class="btn btn-outline-dark">Kembali</a>
            <a href="{{ route('admin.alumni.edit', $alumni) }}" class="btn btn-outline-warning">Edit</a>
        </div>
    </div>
@endsection
