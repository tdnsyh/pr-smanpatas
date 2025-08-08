<div class="mb-3">
    <label>Judul</label>
    <input type="text" name="judul" class="form-control" value="{{ old('judul', $agenda->judul ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Deskripsi Singkat</label>
    <input type="text" name="deskripsi_pendek" class="form-control"
        value="{{ old('deskripsi_pendek', $agenda->deskripsi_pendek ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Deskripsi</label>
    <div id="editor" style="min-height: 200px;">{!! old('isi', $agenda->deskripsi ?? '') !!}</div>
    <input type="hidden" name="deskripsi" id="deskripsi">
</div>

<div class="mb-3">
    <label>Tanggal</label>
    <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', $agenda->tanggal ?? '') }}"
        required>
</div>

<div class="mb-3">
    <label>Lokasi</label>
    <input type="text" name="lokasi" class="form-control" value="{{ old('lokasi', $agenda->lokasi ?? '') }}">
</div>

<div class="mb-3">
    <label>Gambar (optional)</label>
    <input type="file" name="gambar" class="form-control">
</div>

@if (isset($agenda) && $agenda->gambar)
    <div class="mb-3">
        <p>Gambar Saat Ini:</p>
        <img src="{{ asset('storage/' . $agenda->gambar) }}" width="200" class="mb-3">
    </div>
@endif
