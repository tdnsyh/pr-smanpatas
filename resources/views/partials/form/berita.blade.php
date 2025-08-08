@php $edit = isset($berita) @endphp

<div class="mb-3">
    <label>Judul</label>
    <input type="text" name="judul" class="form-control" value="{{ old('judul', $berita->judul ?? '') }}">
</div>

<div class="mb-3">
    <label>Deskripsi</label>
    <div id="editor" style="min-height: 200px;">{!! old('isi', $berita->isi ?? '') !!}</div>
    <input type="hidden" name="isi" id="isi">
</div>

<div class="mb-3">
    <label>Penulis</label>
    <input type="text" name="penulis" class="form-control" value="{{ old('penulis', $berita->penulis ?? '') }}">
</div>

<div class="mb-3">
    <label>Gambar</label>
    <input type="file" name="gambar" class="form-control">
    @if ($edit && $berita->gambar)
        <img src="{{ asset('storage/' . $berita->gambar) }}" width="200" class="mt-2">
    @endif
</div>


@push('style')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
@endpush

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
    <script>
        // Inisialisasi editor Quill dan proses submit form
        document.addEventListener('DOMContentLoaded', function() {
            const quill = new Quill('#editor', {
                theme: 'snow'
            });

            const form = document.getElementById('formCampaign');
            form.addEventListener('submit', function() {
                const deskripsiInput = document.getElementById('isi');
                deskripsiInput.value = quill.root.innerHTML;
            });
        });
    </script>
@endpush
