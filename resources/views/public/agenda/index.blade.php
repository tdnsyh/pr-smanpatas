@extends('layouts.web')
@section('title', 'Agenda')

@section('content')
    @include('partials.navbar')
    <section class="py-4">
        <div class="container">
            <span class="badge text-bg-light rounded-1 py-2 px-3">AGENDA</span>
            <h1 class="fw-semibold mt-2">Agenda</h1>
            <h2>Ikatan Alumni SMAN 4 Tasikmalaya (IKA SMANPATAS)</h2>
            <div class="row row-cols-2 row-cols-md-4 g-3">
                @foreach ($agendas as $agenda)
                    <div class="col">
                        <div class="card h-100 border shadow-none">
                            <div class="card-body d-flex flex-column">
                                <div class="ratio ratio-16x9">
                                    <img src="{{ asset('storage/' . $agenda->gambar) }}" alt="{{ $agenda->judul }}"
                                        class="card-img-top rounded object-fit-cover">
                                </div>
                                <a href="{{ route('agenda.show', $agenda->slug) }}" class="text-decoration-none">
                                    <h5 class="fw-bold mb-0 text-dark card-title mt-3">
                                        {{ \Illuminate\Support\Str::limit($agenda->judul, 60) }}
                                    </h5>
                                </a>
                                <div class="mt-auto">
                                    <div class="d-flex align-items-center mb-1">
                                        <i class="ti ti-calendar-event me-2 text-primary"></i>
                                        <span>{{ \Carbon\Carbon::parse($agenda->tanggal)->format('d F Y, H:i') }}</span>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <i class="ti ti-map-pin me-2 text-warning"></i>
                                        <span>{{ $agenda->lokasi }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
