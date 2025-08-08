@php
    $currentYear = date('Y');
    $pendidikanOptions = ['SMA', 'D1', 'D2', 'D3', 'S1', 'S2', 'S3'];
    $programStudiOptions = [
        'Teknik Informatika',
        'Sistem Informasi',
        'Manajemen',
        'Akuntansi',
        'Hukum',
        'Kedokteran',
        'Ilmu Komunikasi',
        'Pendidikan',
        'Psikologi',
        'Teknik Sipil',
        'Teknik Elektro',
        'Teknik Mesin',
        'Arsitektur',
        'Desain Komunikasi Visual',
        'Desain Produk',
        'Sastra Inggris',
        'Sastra Indonesia',
        'Ilmu Politik',
        'Hubungan Internasional',
        'Biologi',
        'Kimia',
        'Matematika',
        'Statistika',
        'Farmasi',
        'Keperawatan',
        'Kebidanan',
        'Gizi',
        'Pariwisata',
        'Perhotelan',
        'Ilmu Komputer',
        'Teknik Industri',
        'Ilmu Hukum',
        'Ekonomi',
        'Perpajakan',
        'Administrasi Negara',
        'Administrasi Bisnis',
        'Pendidikan Guru SD (PGSD)',
        'Pendidikan Anak Usia Dini (PAUD)',
        'Pendidikan Bahasa Inggris',
        'Pendidikan Matematika',
        'Pendidikan Biologi',
        'Pendidikan Sejarah',
        'Lainnya',
    ];

    $pekerjaanOptions = [
        'PNS',
        'Guru/Dosen',
        'Wirausaha',
        'Karyawan Swasta',
        'Freelancer',
        'Belum Bekerja',
        'Pegawai BUMN',
        'ASN',
        'TNI/Polri',
        'Petani',
        'Nelayan',
        'Dokter',
        'Perawat',
        'Bidan',
        'Apoteker',
        'Programmer',
        'UI/UX Designer',
        'Digital Marketer',
        'Content Creator',
        'YouTuber',
        'Influencer',
        'Driver Online',
        'Sales/Marketing',
        'Customer Service',
        'Teknisi',
        'Operator Pabrik',
        'Staf Admin',
        'Manajer',
        'Pengacara',
        'Notaris',
        'Konsultan',
        'Arsitek',
        'Lainnya',
    ];

    $jabatanOptions = ['Staff', 'Manager', 'Supervisor', 'Direktur', 'Owner', 'Freelancer', 'Lainnya'];
@endphp

<div class="row mb-3">
    <div class="col-md-6">
        <label class="form-label">Nama Lengkap</label>
        <input type="text" class="form-control" name="nama_lengkap"
            value="{{ old('nama_lengkap', $alumni->nama_lengkap ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Nama Panggilan</label>
        <input type="text" class="form-control" name="nama_panggilan"
            value="{{ old('nama_panggilan', $alumni->nama_panggilan ?? '') }}">
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-6">
        <label class="form-label">Tahun Kelulusan</label>
        <select class="form-select" name="tahun_kelulusan">
            <option value="">-- Pilih Tahun --</option>
            @for ($year = $currentYear; $year >= 1980; $year--)
                <option value="{{ $year }}"
                    {{ old('tahun_kelulusan', $alumni->tahun_kelulusan ?? '') == $year ? 'selected' : '' }}>
                    {{ $year }}
                </option>
            @endfor
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">Alamat E-mail</label>
        <input type="email" class="form-control" name="email" value="{{ old('email', $alumni->email ?? '') }}">
        <div class="form-check mt-1">
            <input class="form-check-input" type="checkbox" name="privasi[email]" value="1"
                {{ old('privasi.email', $privasi['email'] ?? false) ? 'checked' : '' }}>
            <label class="form-check-label">Tampilkan ke publik</label>
        </div>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-6">
        <label class="form-label">Nomor WA</label>
        <input type="text" class="form-control" name="no_wa" value="{{ old('no_wa', $alumni->no_wa ?? '') }}">
        <div class="form-check mt-1">
            <input class="form-check-input" type="checkbox" name="privasi[no_wa]" value="1"
                {{ old('privasi.no_wa', $privasi['no_wa'] ?? false) ? 'checked' : '' }}>
            <label class="form-check-label">Tampilkan ke publik</label>
        </div>
    </div>
    <div class="col-md-6">
        <label class="form-label">Alamat Saat Ini</label>
        <textarea class="form-control" name="alamat_saat_ini">{{ old('alamat_saat_ini', $alumni->alamat_saat_ini ?? '') }}</textarea>
        <div class="form-check mt-1">
            <input class="form-check-input" type="checkbox" name="privasi[alamat_saat_ini]" value="1"
                {{ old('privasi.alamat_saat_ini', $privasi['alamat_saat_ini'] ?? false) ? 'checked' : '' }}>
            <label class="form-check-label">Tampilkan ke publik</label>
        </div>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-6">
        <label class="form-label">Jenjang Pendidikan Terakhir</label>
        <select class="form-select" name="jenjang_pendidikan_terakhir">
            <option value="">-- Pilih Jenjang --</option>
            @foreach ($pendidikanOptions as $item)
                <option value="{{ $item }}"
                    {{ old('jenjang_pendidikan_terakhir', $alumni->jenjang_pendidikan_terakhir ?? '') == $item ? 'selected' : '' }}>
                    {{ $item }}
                </option>
            @endforeach
        </select>
        <div class="form-check mt-1">
            <input class="form-check-input" type="checkbox" name="privasi[jenjang_pendidikan_terakhir]" value="1"
                {{ old('privasi.jenjang_pendidikan_terakhir', $privasi['jenjang_pendidikan_terakhir'] ?? false) ? 'checked' : '' }}>
            <label class="form-check-label">Tampilkan ke publik</label>
        </div>
    </div>
    <div class="col-md-6">
        <label class="form-label">Nama Institusi Pendidikan Terakhir</label>
        <input type="text" class="form-control" name="nama_institusi_pendidikan_terakhir"
            value="{{ old('nama_institusi_pendidikan_terakhir', $alumni->nama_institusi_pendidikan_terakhir ?? '') }}">
        <div class="form-check mt-1">
            <input class="form-check-input" type="checkbox" name="privasi[nama_institusi_pendidikan_terakhir]"
                value="1"
                {{ old('privasi.nama_institusi_pendidikan_terakhir', $privasi['nama_institusi_pendidikan_terakhir'] ?? false) ? 'checked' : '' }}>
            <label class="form-check-label">Tampilkan ke publik</label>
        </div>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-6">
        <label class="form-label">Program Studi/Jurusan</label>
        <select class="form-select" name="program_studi">
            <option value="">-- Pilih Program Studi --</option>
            @foreach ($programStudiOptions as $option)
                <option value="{{ $option }}"
                    {{ old('program_studi', $alumni->program_studi ?? '') == $option ? 'selected' : '' }}>
                    {{ $option }}
                </option>
            @endforeach
        </select>
        <div class="form-check mt-1">
            <input class="form-check-input" type="checkbox" name="privasi[program_studi]" value="1"
                {{ old('privasi.program_studi', $privasi['program_studi'] ?? false) ? 'checked' : '' }}>
            <label class="form-check-label">Tampilkan ke publik</label>
        </div>
    </div>
    <div class="col-md-6">
        <label class="form-label">Pekerjaan Saat Ini</label>
        <select class="form-select" name="pekerjaan_saat_ini">
            <option value="">-- Pilih Pekerjaan --</option>
            @foreach ($pekerjaanOptions as $option)
                <option value="{{ $option }}"
                    {{ old('pekerjaan_saat_ini', $alumni->pekerjaan_saat_ini ?? '') == $option ? 'selected' : '' }}>
                    {{ $option }}
                </option>
            @endforeach
        </select>
        <!-- Checkbox privasi DIHAPUS karena field ini default publik -->
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-6">
        <label class="form-label">Nama Instansi/Perusahaan</label>
        <input type="text" class="form-control" name="nama_instansi"
            value="{{ old('nama_instansi', $alumni->nama_instansi ?? '') }}">
        <div class="form-check mt-1">
            <input class="form-check-input" type="checkbox" name="privasi[nama_instansi]" value="1"
                {{ old('privasi.nama_instansi', $privasi['nama_instansi'] ?? false) ? 'checked' : '' }}>
            <label class="form-check-label">Tampilkan ke publik</label>
        </div>
    </div>
    <div class="col-md-6">
        <label class="form-label">Jabatan/Posisi</label>
        <select class="form-select" name="jabatan">
            <option value="">-- Pilih Jabatan --</option>
            @foreach ($jabatanOptions as $option)
                <option value="{{ $option }}"
                    {{ old('jabatan', $alumni->jabatan ?? '') == $option ? 'selected' : '' }}>
                    {{ $option }}
                </option>
            @endforeach
        </select>
        <div class="form-check mt-1">
            <input class="form-check-input" type="checkbox" name="privasi[jabatan]" value="1"
                {{ old('privasi.jabatan', $privasi['jabatan'] ?? false) ? 'checked' : '' }}>
            <label class="form-check-label">Tampilkan ke publik</label>
        </div>
    </div>
</div>

<div class="mb-3">
    <label class="form-label">Lokasi Tempat Bekerja</label>
    <input type="text" class="form-control" name="lokasi_tempat_bekerja"
        value="{{ old('lokasi_tempat_bekerja', $alumni->lokasi_tempat_bekerja ?? '') }}">
    <div class="form-check mt-1">
        <input class="form-check-input" type="checkbox" name="privasi[lokasi_tempat_bekerja]" value="1"
            {{ old('privasi.lokasi_tempat_bekerja', $privasi['lokasi_tempat_bekerja'] ?? false) ? 'checked' : '' }}>
        <label class="form-check-label">Tampilkan ke publik</label>
    </div>
</div>
