@extends('layouts.main')

@section('title', 'Pesanan Saya - Jasain Aja')

@push('styles')
<style>
    .booking-page {
        padding: 40px 0;
    }
    .booking-card {
        border-radius: 16px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.06);
        padding: 24px;
        background: #ffffff;
    }
    .status-badge {
        padding: 4px 10px;
        border-radius: 999px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    /* HANYA judul & subjudul di header yang putih */
    .booking-header h2 {
        color: #ffffff !important;
    }
    .booking-header small {
        color: #e5e7eb !important; /* putih keabu-abuan */
    }
</style>
@endpush



@section('content')
<div class="container booking-page">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="booking-header">
                    <h2 class="mb-0">Pesanan Saya</h2>
                    <small class="text-muted">Daftar pesanan jasa yang pernah kamu buat.</small>
                </div>
            </div>


            <div class="booking-card">

                @if($orders->isEmpty())
                    <div class="text-center py-5">
                        <i class="fa-regular fa-folder-open fa-3x mb-3 text-muted"></i>
                        <h5 class="mb-1">Belum ada pesanan</h5>
                        <p class="text-muted mb-0">
                            Yuk mulai pesan jasa di halaman <a href="{{ route('jasa.index') }}">Jasa</a>.
                        </p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Jasa</th>
                                    <th>Penyedia</th>
                                    <th>Tanggal & Jam</th>
                                    <th>Alamat</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $index => $order)
                                @php
                                    $badgeClass = match($order->status) {
                                        'pending'    => 'bg-secondary text-white',
                                        'diterima'   => 'bg-primary text-white',
                                        'diproses'   => 'bg-warning text-dark',
                                        'selesai'    => 'bg-success text-white',
                                        'dibatalkan' => 'bg-danger text-white',
                                        default      => 'bg-secondary text-white',
                                    };
                                @endphp
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        {{ $order->service->nama_jasa ?? '-' }}<br>
                                        <small class="text-muted">
                                            {{ $order->service->kategori_label ?? '' }}
                                        </small>
                                    </td>
                                    <td>
                                        {{ $order->provider->name ?? 'Penyedia #' . $order->provider_id }}<br>
                                        <small class="text-muted">
                                            {{ $order->provider->email ?? '' }}
                                        </small>
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($order->booking_date)->format('d M Y') }}<br>
                                        <small class="text-muted">{{ $order->booking_time }}</small>
                                    </td>
                                    <td style="max-width: 240px;">
                                        <small>{{ $order->alamat }}</small>
                                    </td>
                                    <td>
                                        <span class="status-badge {{ $badgeClass }}">
                                            {{ $order->status_label }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

            </div>

        </div>
    </div>
</div>
@endsection
