@extends('layouts.main')

@section('title', 'Bayar Pesanan')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-lg border-0 rounded-4 text-center">
                <div class="card-body">
                    <h3 class="mb-2">Konfirmasi Pembayaran</h3>
                    <p class="text-dark mb-4" style="opacity:.8;">
                        Total yang akan dibayar:
                        <strong>Rp {{ number_format($total, 0, ',', '.') }}</strong>
                    </p>

                    <p class="text-muted small mb-3">
                        Ini hanya simulasi. Tekan tombol di bawah untuk menandai bahwa
                        kamu sudah melakukan pembayaran.
                    </p>

                    <form method="POST" action="{{ route('payment.confirm', $token) }}">
                        @csrf
                        <button type="submit" class="btn btn-success w-100">
                            Bayar Sekarang (Simulasi)
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
