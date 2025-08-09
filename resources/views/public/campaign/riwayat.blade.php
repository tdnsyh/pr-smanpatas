 @extends('layouts.web')
 @section('title', $title ?? 'Campaign')
 @section('content')
     @include('partials.navbar')
     <section class="py-3 py-md-4">
         <div class="container col-md-6">
             <div class="mt-3">
                 <h1 class="mb-4">Riwayat Donasi - {{ $campaign->judul }}</h1>
                 @if ($donasi->count())
                     @foreach ($donasi as $item)
                         <div class="card mb-2 mt-3 border shadow-none">
                             <div class="card-body d-flex align-items-start p-3">
                                 <!-- Avatar -->
                                 <div class="avatar rounded-circle d-flex align-items-center justify-content-center me-3 h3"
                                     style="width: 60px; height: 60px; background-color: #6c757d; color: white; font-weight: bold;">
                                     {{ strtoupper(substr($item->nama_donatur, 0, 1)) }}
                                 </div>

                                 <!-- Donasi Info -->
                                 <div>
                                     <p class="mb-0">
                                         <strong>{{ $item->nama_donatur }}</strong>
                                     </p>
                                     <p class="mb-0">berdonasi sebesar
                                         <strong>Rp{{ number_format($item->jumlah, 0, ',', '.') }}</strong>
                                     </p>
                                     <div class="text-muted small mt-1 mb-0">
                                         {{ $item->created_at->diffForHumans() }}
                                     </div>
                                 </div>
                             </div>
                         </div>
                     @endforeach
                 @else
                     <div class="alert alert-info">Belum ada donasi yang terverifikasi untuk campaign ini.</div>
                 @endif
                 <a href="{{ route('campaign.show', $campaign->slug) }}" class="btn btn-outline-secondary">
                     Kembali ke Campaign
                 </a>
             </div>
         </div>
     </section>
 @endsection
