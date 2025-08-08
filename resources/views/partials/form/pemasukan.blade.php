<div class="mb-3">
    <label class="form-label">Kategori</label>
    <select name="kategori" class="form-control" required>
        <option value="">-- Pilih Kategori --</option>
        <option value="Donasi" {{ old('kategori', $pemasukan->kategori ?? '') == 'Donasi' ? 'selected' : '' }}>Donasi
        </option>
        <option value="Iuran Anggota"
            {{ old('kategori', $pemasukan->kategori ?? '') == 'Iuran Anggota' ? 'selected' : '' }}>Iuran Anggota
        </option>
        <option value="Sponsorship" {{ old('kategori', $pemasukan->kategori ?? '') == 'Sponsorship' ? 'selected' : '' }}>
            Sponsorship</option>
        <option value="Penjualan Merchandise"
            {{ old('kategori', $pemasukan->kategori ?? '') == 'Penjualan Merchandise' ? 'selected' : '' }}>Penjualan
            Merchandise</option>
        <option value="Lainnya" {{ old('kategori', $pemasukan->kategori ?? '') == 'Lainnya' ? 'selected' : '' }}>Lainnya
        </option>
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Sumber</label>
    <select name="sumber" class="form-control" required>
        <option value="">-- Pilih Sumber --</option>
        <option value="Anggota" {{ old('sumber', $pemasukan->sumber ?? '') == 'Anggota' ? 'selected' : '' }}>Anggota
        </option>
        <option value="Perusahaan" {{ old('sumber', $pemasukan->sumber ?? '') == 'Perusahaan' ? 'selected' : '' }}>
            Perusahaan</option>
        <option value="Event" {{ old('sumber', $pemasukan->sumber ?? '') == 'Event' ? 'selected' : '' }}>Event</option>
        <option value="Penjualan" {{ old('sumber', $pemasukan->sumber ?? '') == 'Penjualan' ? 'selected' : '' }}>
            Penjualan</option>
        <option value="Lainnya" {{ old('sumber', $pemasukan->sumber ?? '') == 'Lainnya' ? 'selected' : '' }}>Lainnya
        </option>
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Jumlah</label>
    <input type="number" name="jumlah" class="form-control" value="{{ old('jumlah', $pemasukan->jumlah ?? '') }}"
        required>
</div>

<div class="mb-3">
    <label class="form-label">Keterangan</label>
    <textarea name="keterangan" class="form-control">{{ old('keterangan', $pemasukan->keterangan ?? '') }}</textarea>
</div>
