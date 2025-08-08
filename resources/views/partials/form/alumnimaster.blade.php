@csrf

<div class="mb-3">
    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
        value="{{ old('nama_lengkap', $alumni->nama_lengkap ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="tahun_kelulusan" class="form-label">Tahun Kelulusan</label>
    <input type="number" class="form-control" id="tahun_kelulusan" name="tahun_kelulusan"
        value="{{ old('tahun_kelulusan', $alumni->tahun_kelulusan ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
        value="{{ old('tanggal_lahir', isset($alumni) ? $alumni->tanggal_lahir->format('Y-m-d') : '') }}" required>
</div>
