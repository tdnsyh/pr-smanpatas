<div class="mb-3">
    <label>Judul</label>
    <input type="text" name="judul" class="form-control" value="{{ old('judul', $campaign->judul ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="gambar" class="form-label">Gambar Campaign</label>
    <input type="file" name="gambar" class="form-control" accept="image/*">
</div>

@if (isset($campaign) && $campaign->gambar)
    <div class="mb-3">
        <img src="{{ asset('storage/' . $campaign->gambar) }}" alt="Gambar Campaign" class="img-fluid" width="200">
    </div>
@endif

<div class="mb-3">
    <label>Deskripsi</label>
    <div id="editor" style="min-height: 200px;">{!! old('deskripsi', $campaign->deskripsi ?? '') !!}</div>
    <input type="hidden" name="deskripsi" id="deskripsi">
</div>

<div class="mb-3">
    <label>Target Donasi</label>
    <input type="number" name="target_donasi" class="form-control"
        value="{{ old('target_donasi', $campaign->target_donasi ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Status</label>
    <select name="status" class="form-control" required>
        <option value="Aktif" {{ old('status', $campaign->status ?? '') == 'Aktif' ? 'selected' : '' }}>Aktif
        </option>
        <option value="Tidak Aktif" {{ old('status', $campaign->status ?? '') == 'Tidak Aktif' ? 'selected' : '' }}>
            Tidak Aktif</option>
        <option value="Selesai" {{ old('status', $campaign->status ?? '') == 'Selesai' ? 'selected' : '' }}>Selesai
        </option>
    </select>
</div>
