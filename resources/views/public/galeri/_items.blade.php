@foreach ($galeri as $item)
    <div class="konten mt-3 galeri-{{ $item->id }}">
        <h4 class="mb-2">{{ $item->judul }}</h4>
        <p class="text-muted">{{ $item->deskripsi ?? '-' }}</p>
        <p><small class="text-muted">{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</small></p>

        @if ($item->galeriFoto->count())
            <div class="grid row row-cols-2 row-cols-md-4 g-3">
                <div class="grid-sizer"></div>
                @foreach ($item->galeriFoto as $foto)
                    <div class="grid-item col">
                        <a href="{{ asset('storage/' . $foto->gambar) }}">
                            <img src="{{ asset('storage/' . $foto->gambar) }}" alt="Galeri"
                                class="img-fluid rounded fade-in w-100">
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-muted">Belum ada foto.</p>
        @endif
    </div>
@endforeach
