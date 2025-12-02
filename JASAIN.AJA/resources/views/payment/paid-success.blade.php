@extends('layouts.main')

@section('title', 'Pembayaran Berhasil')

@section('content')
<div class="container d-flex flex-column justify-content-center align-items-center" style="min-height: 60vh;">
    
    {{-- Judul dan Teks Utama --}}
    <h3 class="text-white mb-3">Pembayaran Berhasil</h3>
    <p class="text-muted mb-5 text-center" style="max-width: 500px;">
        Kamu bisa menutup halaman ini. Status pesanan di website utama akan
        otomatis berubah setelah beberapa detik.
    </p>

    {{-- KOTAK HUBUNGI PENYEDIA JASA --}}
    <div class="card shadow" style="width: 100%; max-width: 450px; background-color: #1e2530; border: 1px solid #2d3748; border-radius: 12px;">
        <div class="card-body text-center p-4">
            
            <h5 class="text-white mb-3">Hubungi Penyedia Jasa</h5>
            <p class="text-muted small mb-4">
                Simpan bukti ini dan hubungi penyedia jasa untuk konfirmasi pesanan Anda segera.
            </p>

            {{-- Logika Menampilkan Tombol WA --}}
            @if(isset($nomorWaPenyedia) && !empty($nomorWaPenyedia))
                @php
                    // Membersihkan nomor dari karakter aneh (spasi, strip, dll)
                    $cleanNumber = preg_replace('/[^0-9]/', '', $nomorWaPenyedia);
                    
                    // Mengubah 08xx menjadi 628xx agar link WA berfungsi
                    if(substr($cleanNumber, 0, 1) == '0'){
                        $cleanNumber = '62' . substr($cleanNumber, 1);
                    }
                @endphp

                {{-- Tombol Utama --}}
                <a href="https://wa.me/{{ $cleanNumber }}" target="_blank" class="btn btn-success w-100 py-2 mb-3 fw-bold" style="border-radius: 8px;">
                    <i class="fab fa-whatsapp me-2"></i> Chat Penyedia Sekarang
                </a>

                {{-- Info Nomor (Teks) --}}
                <div class="text-muted small">
                    <i class="fas fa-phone-alt me-1"></i> Nomor: {{ $nomorWaPenyedia }}
                </div>
            @else
                {{-- Jika nomor tidak ditemukan di database --}}
                <div class="alert alert-dark border-warning text-warning small mb-0">
                    <i class="fas fa-exclamation-triangle me-1"></i> Nomor kontak penyedia tidak tersedia.
                </div>
            @endif

        </div>
    </div>

</div>
@endsection