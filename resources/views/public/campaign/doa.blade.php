 @extends('layouts.web')
 @section('title', $title ?? 'Campaign')
 @section('content')
     @include('partials.navbar')
     <section class="py-3 py-md-4">
         <div class="container col-md-6">
             <div class="mt-3">
                 <h1 class="mb-4">Do'a orang baik untuk {{ $campaign->judul }}</h1>
                 @if ($doas->count())
                     @foreach ($doas as $item)
                         <div class="card mb-2 mt-3 border shadow-none">
                             <div class="card-body d-flex align-items-start p-3">
                                 <div class="avatar rounded-circle d-flex align-items-center justify-content-center me-3 h3"
                                     style="width: 60px; height: 60px; background-color: #6c757d; color: white; font-weight: bold;">
                                     {{ strtoupper(substr($item->nama, 0, 1)) }}
                                 </div>

                                 <div>
                                     <p class="mb-0">
                                         <strong>{{ $item->nama }}</strong>
                                     </p>
                                     <p class="mb-0">{{ $item->isi }}</p>
                                     <div class="text-muted small mt-1 mb-0">
                                         {{ $item->created_at->diffForHumans() }}
                                     </div>
                                 </div>
                             </div>
                         </div>
                     @endforeach
                 @else
                     <div class="alert alert-info">Belum ada doa untuk campaign ini.</div>
                 @endif
                 <a href="{{ route('campaign.show', $campaign->slug) }}" class="btn btn-outline-secondary mt-3">
                     Kembali ke Campaign
                 </a>
             </div>
         </div>
     </section>
 @endsection
