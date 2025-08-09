@extends('layouts.web')
@section('title', $campaign->judul ?? 'Campaign')
@section('content')
    @include('partials.navbar')
    <section class="py-3 py-md-4">
        <div class="container col-md-6">
            <h1 class="mb-4">Kirim Donasi untuk: {{ $campaign->judul }}</h1>
            <div class="card border shadow-none mb-3">
                <div class="card-header bg-primary text-white py-3">
                    Informasi Transfer
                </div>
                <div class="card-body">
                    <p class="mb-1">Silakan transfer donasi ke rekening berikut:</p>
                    <ul class="list-unstyled mb-3">
                        <li><strong>Bank:</strong> BCA</li>
                        <li><strong>No. Rekening:</strong> 1234567890</li>
                        <li><strong>Atas Nama:</strong> Yayasan Amal Sejahtera</li>
                    </ul>

                    <!-- Accordion Panduan -->
                    <div class="accordion" id="panduanTransfer">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingPanduan">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapsePanduan" aria-expanded="false" aria-controls="collapsePanduan">
                                    Panduan Transfer
                                </button>
                            </h2>
                            <div id="collapsePanduan" class="accordion-collapse collapse" aria-labelledby="headingPanduan"
                                data-bs-parent="#panduanTransfer">
                                <div class="accordion-body">
                                    <ol class="mb-0">
                                        <li>Buka aplikasi m-banking atau ATM Anda.</li>
                                        <li>Pilih menu transfer ke rekening bank.</li>
                                        <li>Masukkan nomor rekening: <strong>1234567890</strong></li>
                                        <li>Pastikan nama penerima adalah: <strong>Yayasan Amal Sejahtera</strong></li>
                                        <li>Masukkan nominal donasi yang sesuai.</li>
                                        <li>Setelah berhasil transfer, simpan bukti transfer Anda.</li>
                                        <li>Kembali ke halaman ini untuk mengupload bukti transfer.</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info mt-3 mb-0">
                        Setelah transfer, jangan lupa upload bukti transfer pada form donasi.
                    </div>
                </div>
            </div>
            <form action="{{ route('campaign.donasi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="campaign_id" value="{{ $campaign->id }}">

                <div class="mb-3">
                    <label for="nama_donatur" class="form-label">Nama Donatur</label>
                    <input type="text" name="nama_donatur" class="form-control"
                        value="{{ Auth::check() ? Auth::user()->name : '' }}" required>
                </div>

                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah Donasi</label>
                    <input type="number" name="jumlah" class="form-control" required min="1">
                </div>

                <div class="mb-3">
                    <label for="bukti_transfer" class="form-label">Bukti Transfer (Opsional)</label>
                    <input type="file" name="bukti_transfer" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <textarea name="keterangan" class="form-control" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary rounded">Kirim Donasi</button>
                <a href="{{ route('campaign.show', $campaign->slug) }}" class="btn btn-outline-secondary rounded">
                    Kembali ke Campaign
                </a>
            </form>
        </div>
    </section>
@endsection
