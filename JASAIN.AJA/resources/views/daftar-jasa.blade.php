@extends('layouts.main')

@section('title', 'Daftar Jasa - Jasain Aja')

@push('styles')
    @vite('resources/css/daftar-jasa.css')
@endpush

@section('content')
    <main class="daftar-jasa-page">
        <div class="dj-container">
            <div class="dj-card">

                {{-- SIDEBAR STEP --}}
                <aside class="dj-sidebar">
                    <button class="dj-step-btn active" type="button" data-step-btn="0">
                        INFORMASI PRIBADI
                    </button>
                    <button class="dj-step-btn" type="button" data-step-btn="1">
                        INFORMASI JASA
                    </button>
                    <button class="dj-step-btn" type="button" data-step-btn="2">
                        LOKASI LAYANAN
                    </button>
                    <button class="dj-step-btn" type="button" data-step-btn="3">
                        VERIFIKASI
                    </button>
                </aside>

                {{-- FORM MULTI STEP --}}
                <section class="dj-form-wrapper">
                    <form action="{{ route('daftar-jasa.store') }}" method="POST" enctype="multipart/form-data" id="dj-multistep-form">
                        @csrf

                        {{-- STEP 0: INFORMASI PRIBADI --}}
                        <div class="dj-step-panel active" data-step="0">
                            <h4 class="dj-form-title">Informasi Pribadi</h4>

                            {{-- NAME --}}
                            <div class="dj-form-group">
                                <label for="nama">Nama</label>
                                <input
                                    id="nama"
                                    name="nama"
                                    type="text"
                                    placeholder="Masukkan nama lengkap"
                                    value="{{ auth()->user()->name }}"
                                    {{ auth()->user()->name ? 'readonly' : '' }}>
                            </div>

                            {{-- USERNAME --}}
                            <div class="dj-form-group">
                                <label for="username">Username</label>
                                <input
                                    id="username"
                                    name="username"
                                    type="text"
                                    placeholder="Nama pengguna"
                                    value="{{ auth()->user()->username }}"
                                    {{ auth()->user()->username ? 'readonly' : '' }}>
                            </div>

                            {{-- EMAIL --}}
                            <div class="dj-form-group">
                                <label for="email">Email</label>
                                <input
                                    id="email"
                                    name="email"
                                    type="email"
                                    placeholder="Email aktif"
                                    value="{{ auth()->user()->email }}"
                                    readonly>
                            </div>

                            {{-- TELEPON --}}
                            <div class="dj-form-group">
                                <label for="telepon">No Telepon</label>
                                <input
                                    id="telepon"
                                    name="telepon"
                                    type="text"
                                    placeholder="Nomor WhatsApp"
                                    value="{{ auth()->user()->telepon }}"
                                    {{ auth()->user()->telepon ? 'readonly' : '' }}>
                            </div>

                            {{-- ALAMAT --}}
                            <div class="dj-form-group">
                                <label for="alamat">Alamat</label>
                                <textarea
                                    id="alamat"
                                    name="alamat"
                                    rows="3"
                                    placeholder="Tulis alamat lengkap"
                                    {{ auth()->user()->alamat ? 'readonly' : '' }}
                                >{{ auth()->user()->alamat }}</textarea>
                            </div>

                            <div class="dj-actions">
                                <button type="button" class="dj-btn dj-btn-back dj-prev" disabled>BACK</button>
                                <button type="button" class="dj-btn dj-btn-next dj-next">NEXT</button>
                            </div>
                        </div>


                        {{-- STEP 1: INFORMASI JASA --}}
                        <div class="dj-step-panel" data-step="1">
                            <h4 class="dj-form-title">Informasi Jasa</h4>

                            <div class="dj-form-group">
                                <label for="nama_jasa">Nama Jasa / Usaha</label>
                                <input id="nama_jasa" name="nama_jasa" type="text"
                                       placeholder="Contoh: Cleaning Service Ibu Sari">
                            </div>

                            <div class="dj-form-group">
                                <label for="kategori">Kategori Jasa</label>
                                <select id="kategori" name="kategori">
                                    <option value="">Pilih kategori</option>
                                    <option value="cleaning">Cleaning Service</option>
                                    <option value="teknisi">Teknisi / Perbaikan</option>
                                    <option value="babysitter">Babysitter</option>
                                    <option value="homecare">Home Care</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                            </div>

                            <div class="dj-form-group">
                                <label for="deskripsi">Deskripsi Jasa</label>
                                <textarea id="deskripsi" name="deskripsi" rows="3"
                                          placeholder="Jelaskan layanan yang Anda tawarkan."></textarea>
                            </div>

                            <div class="dj-form-group">
                                <label for="pengalaman">Pengalaman Kerja (tahun)</label>
                                <input id="pengalaman" name="pengalaman" type="number" min="0"
                                       placeholder="Contoh: 3">
                            </div>

                            <div class="dj-form-group">
                                <label for="harga_mulai">Harga Mulai Dari (Rp)</label>
                                <input id="harga_mulai" name="harga_mulai" type="number" min="0"
                                       placeholder="Contoh: 100000">
                            </div>

                            <div class="dj-actions">
                                <button type="button" class="dj-btn dj-btn-back dj-prev">BACK</button>
                                <button type="button" class="dj-btn dj-btn-next dj-next">NEXT</button>
                            </div>
                        </div>

                        {{-- STEP 2: LOKASI LAYANAN --}}
                        <div class="dj-step-panel" data-step="2">
                            <h4 class="dj-form-title">Lokasi Layanan</h4>

                            <div class="dj-form-group">
                                <label for="kota">Kota / Kabupaten</label>
                                <input id="kota" name="kota" type="text" placeholder="Contoh: Surabaya">
                            </div>

                            <div class="dj-form-group">
                                <label for="area_layanan">Area Layanan</label>
                                <textarea id="area_layanan" name="area_layanan" rows="3"
                                          placeholder="Contoh: Seluruh wilayah Surabaya Timur."></textarea>
                            </div>

                            <div class="dj-form-group">
                                <label for="hari_kerja">Hari Kerja</label>
                                <input id="hari_kerja" name="hari_kerja" type="text" placeholder="Contoh: Senin-Sabtu">
                            </div>

                            <div class="dj-form-group">
                                <label for="jam_operasional">Jam Operasional</label>
                                <input id="jam_operasional" name="jam_operasional" type="text"
                                       placeholder="Contoh: 08.00–17.00">
                            </div>

                            <div class="dj-actions">
                                <button type="button" class="dj-btn dj-btn-back dj-prev">BACK</button>
                                <button type="button" class="dj-btn dj-btn-next dj-next">NEXT</button>
                            </div>
                        </div>

                        {{-- STEP 3: VERIFIKASI --}}
                        <div class="dj-step-panel" data-step="3">
                            <h4 class="dj-form-title">Verifikasi</h4>

                            <div class="dj-form-group">
                                <label for="ktp">Upload KTP (opsional)</label>
                                <input id="ktp" name="ktp" type="file" accept="image/*,application/pdf">
                            </div>

                           {{-- PORTOFOLIO (opsional, boleh multiple) --}}
                            <div class="dj-form-group">
                                <label for="portofolio">Portofolio (opsional)</label>
                                <input
                                    id="portofolio"
                                    name="portofolio[]"
                                    type="file"
                                    multiple
                                    accept="image/*">
                            </div>

                            <div class="dj-form-group">
                                <label for="foto_jasa">Foto Jasa</label>
                                <input id="foto_jasa" name="foto_jasa[]" type="file" multiple accept="image/*">
                            </div>

                            <div class="dj-form-group dj-checkbox-group">
                                <label>
                                    <input type="checkbox" name="setuju" value="1">
                                    <span>
                                        Saya menyatakan bahwa data yang saya berikan benar dan saya siap
                                        mengikuti kebijakan Jasain Aja.
                                    </span>
                                </label>
                            </div>

                            <div class="dj-actions">
                                <button type="button" class="dj-btn dj-btn-back dj-prev">BACK</button>
                                <button type="submit" class="dj-btn dj-btn-next">
                                    KIRIM PENDAFTARAN
                                </button>
                            </div>
                        </div>
                    </form>
                </section>

            </div>

            <p class="dj-footer-text">
                Isi data Anda dengan benar untuk memulai menjadi penyedia jasa di Jasain Aja
            </p>
        </div>
    </main>
@endsection

@push('scripts')
    @vite('resources/js/daftar-jasa.js')
@endpush
