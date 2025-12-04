@extends('layouts.main') {{-- Sesuaikan dengan layout utamamu --}}

@section('title', 'Dompet Saya')

@section('content')
<div class="container py-5">
    <div class="row">
        
        {{-- BAGIAN KIRI: SALDO & FORM TARIK TUNAI --}}
        <div class="col-md-4 mb-4">
            
            {{-- Kartu Saldo --}}
            <div class="card shadow-sm border-0 mb-4 bg-primary text-white" style="border-radius: 15px; background: linear-gradient(45deg, #4f46e5, #3b82f6);">
                <div class="card-body p-4 text-center">
                    <p class="mb-1 opacity-75">Saldo Dompet Anda</p>
                    <h2 class="fw-bold mb-0">Rp {{ number_format($user->saldo, 0, ',', '.') }}</h2>
                </div>
            </div>

            {{-- Form Tarik Tunai --}}
            <div class="card shadow-sm border-0" style="border-radius: 15px;">
                <div class="card-body p-4">
                    <h5 class="card-title fw-bold mb-3"><i class="fas fa-money-bill-wave me-2"></i>Tarik Tunai</h5>
                    <p class="text-muted small">Dana akan ditransfer ke rekening bank Anda.</p>
                    
                    <form action="{{ route('wallet.withdraw') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Jumlah Penarikan (Rp)</label>
                            <input type="number" name="amount" class="form-control" placeholder="Min. 10.000" required min="10000">
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold">Nama Bank</label>
                            <input type="text" name="bank_name" class="form-control" placeholder="Contoh: BCA, BRI" value="{{ $user->nama_bank ?? '' }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold">Nomor Rekening</label>
                            <input type="text" name="account_number" class="form-control" placeholder="Nomor Rekening Anda" value="{{ $user->nomor_rekening ?? '' }}" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary fw-bold" onclick="return confirm('Apakah Anda yakin ingin menarik dana ini?')">
                                Ajukan Penarikan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- BAGIAN KANAN: RIWAYAT TRANSAKSI --}}
        <div class="col-md-8">
            <div class="card shadow-sm border-0" style="border-radius: 15px;">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-history me-2"></i>Riwayat Transaksi</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4">Tanggal</th>
                                    <th>Keterangan</th>
                                    <th>Tipe</th>
                                    <th class="text-end pe-4">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($transactions as $trx)
                                    <tr>
                                        <td class="ps-4 text-muted small">
                                            {{ $trx->created_at->format('d M Y') }}<br>
                                            {{ $trx->created_at->format('H:i') }}
                                        </td>
                                        <td>
                                            <span class="d-block text-dark fw-medium">{{ Str::limit($trx->description, 40) }}</span>
                                            @if($trx->order_id)
                                                <small class="text-primary">Order #{{ $trx->order_id }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            @if($trx->type == 'credit')
                                                <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">Pemasukan</span>
                                            @else
                                                <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill">Penarikan</span>
                                            @endif
                                        </td>
                                        <td class="text-end pe-4 fw-bold {{ $trx->type == 'credit' ? 'text-success' : 'text-danger' }}">
                                            {{ $trx->type == 'credit' ? '+' : '-' }} 
                                            Rp {{ number_format($trx->amount, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-5 text-muted">
                                            <i class="fas fa-wallet fa-3x mb-3 text-secondary opacity-25"></i>
                                            <p>Belum ada riwayat transaksi.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection