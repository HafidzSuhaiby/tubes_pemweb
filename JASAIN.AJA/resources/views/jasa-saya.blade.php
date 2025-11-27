@extends('layouts.main')

@section('title', 'Jasa Saya - Jasain Aja')

@push('styles')
    @vite('resources/css/daftar-jasa.css')
@endpush

@section('content')
    <main class="daftar-jasa-page">
        <div class="dj-container">
            <div class="dj-card">

                {{-- SIDEBAR: 2 MENU --}}
                <aside class="dj-sidebar">
                    <button class="dj-step-btn active" type="button" data-tab-target="tab-info">
                        INFORMASI JASA
                    </button>
                    <button class="dj-step-btn" type="button" data-tab-target="tab-orders">
                        PESANAN SAYA
                    </button>
                </aside>

                {{-- KONTEN KANAN --}}
                <section class="dj-form-wrapper">

                    {{-- TAB 1: INFORMASI JASA --}}
                    <div class="my-service-tab active" id="tab-info">
                        @php
                            $status = $registration->status;
                        @endphp

                        <div class="my-service-header d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h2 class="my-service-title">Jasa Saya</h2>
                                <p class="my-service-sub">
                                    Detail jasa yang sudah kamu daftarkan di Jasain Aja.
                                </p>
                            </div>

                            {{-- BADGE STATUS --}}
                            <div>
                                @if($status === 'approved')
                                    <span class="badge-status badge-status-approved">Disetujui</span>
                                @elseif($status === 'pending')
                                    <span class="badge-status badge-status-pending">Menunggu Review</span>
                                @else
                                    <span class="badge-status badge-status-rejected">Ditolak</span>
                                @endif
                            </div>
                        </div>

                        <hr class="my-3">

                        {{-- INFORMASI JASA --}}
                        <section class="my-service-section">
                            <h5 class="my-service-section-title">Informasi Jasa</h5>

                            <div class="row g-3 my-service-info">
                                <div class="col-md-6">
                                    <p class="info-label">Nama Jasa</p>
                                    <p class="info-value">{{ $registration->nama_jasa }}</p>
                                </div>

                                <div class="col-md-6">
                                    <p class="info-label">Kategori</p>
                                    <p class="info-value">{{ $registration->kategori_label }}</p>
                                </div>

                                <div class="col-md-6">
                                    <p class="info-label">Kota</p>
                                    <p class="info-value">{{ $registration->kota ?? '-' }}</p>
                                </div>

                                <div class="col-md-6">
                                    <p class="info-label">Area Layanan</p>
                                    <p class="info-value">{{ $registration->area_layanan ?? '-' }}</p>
                                </div>

                                <div class="col-md-6">
                                    <p class="info-label">Hari Kerja</p>
                                    <p class="info-value">{{ $registration->hari_kerja ?? '-' }}</p>
                                </div>

                                <div class="col-md-6">
                                    <p class="info-label">Jam Operasional</p>
                                    <p class="info-value">{{ $registration->jam_operasional ?? '-' }}</p>
                                </div>

                                <div class="col-md-6">
                                    <p class="info-label">Harga Mulai</p>
                                    <p class="info-value">
                                        @if($registration->harga_mulai)
                                            Rp {{ number_format($registration->harga_mulai, 0, ',', '.') }}
                                        @else
                                            -
                                        @endif
                                    </p>
                                </div>

                                <div class="col-12">
                                    <p class="info-label">Deskripsi</p>
                                    <p class="info-value">
                                        {{ $registration->deskripsi ?: '-' }}
                                    </p>
                                </div>
                            </div>
                        </section>
                    </div>

                    {{-- TAB 2: PESANAN SAYA --}}
                        <div class="my-service-tab" id="tab-orders">
                            <div class="my-service-header mb-3">
                                <h2 class="my-service-title">Pesanan Saya</h2>
                                <p class="my-service-sub">
                                    Pesanan dari pengguna yang masuk ke jasa kamu.
                                </p>
                            </div>

                            @if(!$registration)
                                <div class="my-service-empty">
                                    <i class="fa-regular fa-folder-open my-service-empty-icon"></i>
                                    <p class="my-service-empty-title">Belum ada jasa aktif</p>
                                    <p class="my-service-empty-sub">
                                        Daftarkan jasa terlebih dahulu untuk bisa menerima pesanan.
                                    </p>
                                </div>
                            @elseif($orders->isEmpty())
                                <div class="my-service-empty">
                                    <i class="fa-regular fa-folder-open my-service-empty-icon"></i>
                                    <p class="my-service-empty-title">Belum ada pesanan masuk</p>
                                    <p class="my-service-empty-sub">
                                        Pesanan dari pengguna akan muncul di sini begitu ada yang melakukan booking.
                                    </p>
                                </div>
                            @else
                                <div class="table-responsive my-service-table-wrapper">
                                    <table class="table align-middle">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Pemesan</th>
                                                <th>Tanggal & Jam</th>
                                                <th>Alamat</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($orders as $index => $order)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>
                                                        {{ $order->user->name ?? 'User #' . $order->user_id }}<br>
                                                        <small class="text-muted">{{ $order->user->email ?? '' }}</small>
                                                    </td>
                                                    <td>
                                                        {{ \Carbon\Carbon::parse($order->booking_date)->format('d M Y') }}
                                                        {{ $order->booking_time }}
                                                    </td>
                                                    <td style="max-width: 240px;">
                                                        <small>{{ $order->alamat }}</small>
                                                    </td>
                                                    <td>
                                                        @php
                                                            $badgeClass = match($order->status) {
                                                                'pending'    => 'bg-secondary',
                                                                'diterima'   => 'bg-primary',
                                                                'diproses'   => 'bg-warning text-dark',
                                                                'selesai'    => 'bg-success',
                                                                'dibatalkan' => 'bg-danger',
                                                                default      => 'bg-secondary',
                                                            };
                                                        @endphp
                                                        <span class="badge {{ $badgeClass }}">
                                                            {{ $order->status_label }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <form method="POST" action="{{ route('orders.update-status', $order->id) }}" class="d-flex gap-2">
                                                            @csrf
                                                            @method('PUT')
                                                            <select name="status" class="form-select form-select-sm">
                                                                <option value="pending"    @selected($order->status === 'pending')>Pending</option>
                                                                <option value="diterima"   @selected($order->status === 'diterima')>Diterima</option>
                                                                <option value="diproses"   @selected($order->status === 'diproses')>Diproses</option>
                                                                <option value="selesai"    @selected($order->status === 'selesai')>Selesai</option>
                                                                <option value="dibatalkan" @selected($order->status === 'dibatalkan')>Dibatalkan</option>
                                                            </select>
                                                            <button type="submit" class="btn btn-sm btn-dark">
                                                                Simpan
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>


                        {{-- 
                        NANTI kalau sudah ada data pesanan:
                        <div class="table-responsive mt-3">
                            <table class="table table-sm align-middle">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Pemesan</th>
                                        <th>Layanan</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            ...
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        --}}
                    </div>

                </section>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const buttons = document.querySelectorAll('.dj-sidebar .dj-step-btn');
        const tabs = document.querySelectorAll('.my-service-tab');

        buttons.forEach(btn => {
            btn.addEventListener('click', () => {
                // ubah active di tombol
                buttons.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');

                const targetId = btn.getAttribute('data-tab-target');

                // show/hide tab
                tabs.forEach(tab => {
                    if (tab.id === targetId) {
                        tab.classList.add('active');
                    } else {
                        tab.classList.remove('active');
                    }
                });
            });
        });
    });
</script>
@endpush
