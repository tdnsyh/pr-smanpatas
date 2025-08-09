@extends('layouts.web')
@section('title', 'Galeri')

@section('content')
    @include('partials.navbar')
    <section class="py-3 py-md-4">
        <div class="container">
            <div class="row row-cols-1 row-cols-md-2 align-items-center">
                <div class="col">
                    <span class="badge text-bg-light rounded-1 py-2 px-3">GALERI</span>
                    <h1 class="fw-semibold mt-2">Galeri</h1>
                </div>
                <div class="col text-md-end mt-2 mt-md-0">
                    <p class="d-inline-flex gap-1">
                        <a class="btn btn-outline-warning rounded-pill px-4" data-bs-toggle="collapse" href="#collapseExample"
                            role="button" aria-expanded="false" aria-controls="collapseExample">
                            <i class="ti ti-filter"></i> Filter
                        </a>
                    </p>
                </div>
            </div>

            <div class="mb-3">
                <div class="collapse" id="collapseExample">
                    <button class="btn btn-outline-dark filter-btn me-1 mb-2 active rounded-pill px-4"
                        data-filter="all">Semua</button>
                    @foreach ($galeri as $item)
                        <button class="btn btn-outline-dark filter-btn me-1 mb-2 rounded-pill px-4"
                            data-filter="{{ $item->id }}">{{ $item->judul }}</button>
                    @endforeach
                </div>
            </div>

            <div class="dd"></div>

            <div class="text-center py-4">
                <button id="loadMoreBtn" class="btn btn-outline-primary rounded-pill px-4">
                    Lihat Lebih Banyak
                </button>
            </div>
        </div>
    </section>
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/css/lightgallery-bundle.min.css">
@endpush

@push('script')
    <script src="https://unpkg.com/imagesloaded@5/imagesloaded.pkgd.min.js"></script>
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/lightgallery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/plugins/thumbnail/lg-thumbnail.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/plugins/zoom/lg-zoom.min.js"></script>
    <script src="{{ asset('assets/js/galeri.js') }}"></script>
@endpush
