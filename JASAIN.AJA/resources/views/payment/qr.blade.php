@extends('layouts.main')

@section('title', 'QR Pembayaran')

@push('styles')
<style>
    .qr-wrapper {
        max-width: 420px;
        margin: 40px auto 80px;
    }
    .qr-card {
        border-radius: 18px;
        box-shadow: 0 14px 35px rgba(0,0,0,0.2);
        border: 1px solid rgba(255,255,255,.05);
        background: #0f172a;
        color: #e5e7eb;
        padding: 24px 24px 28px;
    }
    .qr-badge {
        font-size: .75rem;
        padding: 4px 10px;
        border-radius: 999px;
        background: rgba(37,99,235,.1);
        color: #60a5fa;
    }
    .qr-amount {
        font-size: 1.6rem;
        font-weight: 700;
    }
    .qr-method {
        font-size: .9rem;
        opacity: .9;
    }
    .qr-image-box {
        border-radius: 14px;
        background: #020617;
        padding: 14px;
        margin: 18px 0 10px;
    }
    .qr-info {
        font-size: .8rem;
        color: #9ca3af;
    }
    .qr-actions .btn {
        border-radius: 999px;
    }
</style>
@endpush

@section('content')
<div class="container">
    <div class="qr-wrapper">

        <div class="qr-card">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="qr-badge">Menunggu Pembayaran</span>
                <small class="text-muted">
                    Token: {{ \Illuminate\Support\Str::limit($token, 8, '...') }}
                </small>
            </div>

            <h4 class="mb-1">Scan QR untuk Membayar</h4>
            <p class="qr-method mb-3">
                Metode: <strong class="text-info text-capitalize">{{ $method }}</strong>
            </p>

            <p class="qr-amount mb-1">
                Rp {{ number_format($total, 0, ',', '.') }}
            </p>
            <small class="text-muted d-block mb-3">
                Pastikan nominal pembayaran sesuai.
            </small>

            <div class="qr-image-box d-flex flex-column align-items-center">
                {{-- QR CODE ASLI --}}
                <div class="bg-white p-2 rounded-3 mb-2">
                    {!! QrCode::size(220)->margin(1)->generate($payUrl) !!}
                </div>

                <small class="qr-info">
                    Scan menggunakan aplikasi {{ ucfirst($method) }} di ponsel Anda.
                </small>
            </div>

            <p class="qr-info mb-3">
                Setelah discan, kamu akan diarahkan ke halaman konfirmasi pembayaran di HP.
                Jika tombol &quot;Bayar&quot; di HP sudah ditekan, status di sini bisa
                dianggap <strong>Lunas</strong> (simulasi).
            </p>

            <div class="qr-actions d-flex flex-column flex-sm-row gap-2">
                <a href="{{ route('payment.pay-page', $token) }}" class="btn btn-primary w-100">
                    Saya Sudah Bayar
                </a>
                <a href="{{ route('cart.index') }}" class="btn btn-outline-light w-100">
                    Kembali ke Keranjang
                </a>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const checkUrl    = @json(route('payment.status', $token));
    const redirectUrl = @json(route('booking')); // setelah paid pindah ke "Pesanan Saya"

    function checkStatus() {
        fetch(checkUrl, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.payment_status === 'paid') {
                // kalau sudah lunas → pindah halaman
                window.location.href = redirectUrl;
            } else {
                // kalau belum, cek lagi 3 detik lagi
                setTimeout(checkStatus, 3000);
            }
        })
        .catch(() => {
            // error jaringan → coba lagi 5 detik
            setTimeout(checkStatus, 5000);
        });
    }

    // mulai polling
    checkStatus();
});
</script>
@endpush
