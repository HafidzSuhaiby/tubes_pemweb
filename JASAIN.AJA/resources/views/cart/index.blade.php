@extends('layouts.main')

@section('title', 'Keranjang Saya')

@push('styles')
<style>
    .cart-card {
        border-radius: 20px;
        border: none;
    }
</style>
@endpush

@section('content')
<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-lg-10">

            {{-- === CARD PEMBUNGKUS === --}}
            <div class="card cart-card shadow-lg">
                <div class="card-body">

                    {{-- ===== JUDUL DAN SUBJUDUL (DI DALAM CARD) ===== --}}
                    <h2 class="fw-bold mb-1">Keranjang Pesanan</h2>
                    <p class="text-dark mb-4" style="opacity: .8;">
                        Pilih pesanan yang ingin kamu checkout terlebih dahulu.
                    </p>

                    @if($carts->isEmpty())

                        <div class="text-center py-5">
                            <i class="fa-regular fa-folder-open fa-3x mb-3 text-muted"></i>
                            <h5 class="mb-1">Keranjang masih kosong</h5>
                            <p class="text-muted mb-0">
                                Yuk cari jasa di halaman <a href="{{ route('jasa.index') }}">Jasa</a>.
                            </p>
                        </div>

                    @else

                        {{-- FORM CHECKOUT --}}
                        <form method="POST" action="{{ route('cart.checkout') }}">
                            @csrf

                            <div class="table-responsive mb-4">
                                <table class="table align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-center" style="width: 40px;">
                                                <input type="checkbox" id="checkAll">
                                            </th>
                                            {{-- <th>#</th> --}} {{-- nomor dihapus --}}
                                            <th>Jasa</th>
                                            <th>Penyedia</th>
                                            <th>Jadwal</th>
                                            <th>Alamat</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($carts as $item)
                                        <tr>
                                            <td class="text-center">
                                                <input type="checkbox"
                                                    name="cart_ids[]"
                                                    value="{{ $item->id }}"
                                                    class="form-check-input cart-checkbox">
                                            </td>

                                            <td>
                                                <strong>{{ $item->service->nama_jasa ?? '-' }}</strong><br>
                                                <small class="text-muted">
                                                    {{ $item->service->kategori_label ?? '' }}
                                                </small>
                                            </td>

                                            <td>
                                                {{ $item->provider->name ?? 'Penyedia #' . $item->provider_id }}<br>
                                                <small class="text-muted">
                                                    {{ $item->provider->email ?? '' }}
                                                </small>
                                            </td>

                                            <td>
                                                {{ \Carbon\Carbon::parse($item->booking_date)->format('d M Y') }}<br>
                                                <small class="text-muted">{{ $item->booking_time }}</small>
                                            </td>

                                            <td style="max-width: 260px;">
                                                <small>{{ $item->alamat }}</small>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{-- RINGKASAN & TOMBOL --}}
                            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">

                                <div class="small text-dark">
                                    Total item di keranjang: <strong>{{ $carts->count() }}</strong><br>
                                    <span id="selected-count">Dipilih: 0</span>
                                </div>

                                <button type="submit" class="btn btn-primary px-4">
                                    Checkout Pesanan Terpilih
                                </button>
                            </div>

                        </form>
                    @endif

                </div>
            </div>

        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const checkAll = document.getElementById('checkAll');
    const checkboxes = document.querySelectorAll('.cart-checkbox');
    const selectedCountEl = document.getElementById('selected-count');

    function updateSelectedCount() {
        let selected = document.querySelectorAll('.cart-checkbox:checked').length;
        if (selectedCountEl) {
            selectedCountEl.textContent = 'Dipilih: ' + selected;
        }
    }

    if (checkAll) {
        checkAll.addEventListener('change', function () {
            checkboxes.forEach(cb => cb.checked = this.checked);
            updateSelectedCount();
        });
    }

    checkboxes.forEach(cb => {
        cb.addEventListener('change', function () {
            if (!this.checked && checkAll) {
                checkAll.checked = false;
            }
            updateSelectedCount();
        });
    });

    updateSelectedCount();
});
</script>
@endpush
