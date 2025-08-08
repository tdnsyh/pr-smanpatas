<div class="mb-3">
    <label class="form-label">Kategori</label>
    <select name="kategori" class="form-control" required>
        <option value="">-- Pilih Kategori --</option>
        <option value="Operasional"
            {{ old('kategori', $pengeluaran->kategori ?? '') == 'Operasional' ? 'selected' : '' }}>Operasional</option>
        <option value="Kegiatan Alumni"
            {{ old('kategori', $pengeluaran->kategori ?? '') == 'Kegiatan Alumni' ? 'selected' : '' }}>Kegiatan Alumni
        </option>
        <option value="Sosial" {{ old('kategori', $pengeluaran->kategori ?? '') == 'Sosial' ? 'selected' : '' }}>Sosial
        </option>
        <option value="Pembelian Barang"
            {{ old('kategori', $pengeluaran->kategori ?? '') == 'Pembelian Barang' ? 'selected' : '' }}>Pembelian Barang
        </option>
        <option value="Administrasi"
            {{ old('kategori', $pengeluaran->kategori ?? '') == 'Administrasi' ? 'selected' : '' }}>Administrasi
        </option>
        <option value="Lainnya" {{ old('kategori', $pengeluaran->kategori ?? '') == 'Lainnya' ? 'selected' : '' }}>
            Lainnya</option>
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Sumber</label>
    <select name="sumber" class="form-control" required>
        <option value="">-- Pilih Sumber Dana --</option>
        <option value="Kas Organisasi"
            {{ old('sumber', $pengeluaran->sumber ?? '') == 'Kas Organisasi' ? 'selected' : '' }}>Kas Organisasi
        </option>
        <option value="Donatur" {{ old('sumber', $pengeluaran->sumber ?? '') == 'Donatur' ? 'selected' : '' }}>Donatur
        </option>
        <option value="Dana Event" {{ old('sumber', $pengeluaran->sumber ?? '') == 'Dana Event' ? 'selected' : '' }}>
            Dana Event</option>
        <option value="Sponsorship" {{ old('sumber', $pengeluaran->sumber ?? '') == 'Sponsorship' ? 'selected' : '' }}>
            Sponsorship</option>
        <option value="Lainnya" {{ old('sumber', $pengeluaran->sumber ?? '') == 'Lainnya' ? 'selected' : '' }}>Lainnya
        </option>
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Jumlah</label>
    <input type="number" name="jumlah" class="form-control" value="{{ old('jumlah', $pengeluaran->jumlah ?? '') }}"
        required>
</div>

<div class="mb-3">
    <label class="form-label">Keterangan</label>
    <textarea name="keterangan" class="form-control">{{ old('keterangan', $pengeluaran->keterangan ?? '') }}</textarea>
</div>
