<?php $__env->startSection('title', 'Daftar Jasa - Jasain Aja'); ?>

<?php $__env->startPush('styles'); ?>
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/daftar-jasa.css'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <main class="daftar-jasa-page">
        <div class="dj-container">
            <div class="dj-card">

                
                <?php if(isset($registration) && $registration): ?>
                    <div class="mb-6 p-4 rounded-lg
                        <?php if($registration->status === 'pending'): ?>
                            bg-yellow-50 border border-yellow-300 text-yellow-800
                        <?php elseif($registration->status === 'approved'): ?>
                            bg-green-50 border border-green-300 text-green-800
                        <?php else: ?>
                            bg-red-50 border border-red-300 text-red-800
                        <?php endif; ?>
                    ">
                        <?php $status = $registration->status; ?>

                        <div class="dj-status-layout">
                            
                            <div class="dj-status-left">
                                <p class="font-bold mb-2">Status pendaftaran jasa Anda:</p>
                                <br>
                                <p>
                                    <?php if($status === 'pending'): ?>
                                        Sedang ditinjau oleh admin.
                                    <?php elseif($status === 'approved'): ?>
                                       <span class="text-green"> Pendaftaran disetujui! </span> <br><br> Anda sudah menjadi <br> penyedia jasa.
                                    <?php else: ?>
                                        <span class="text-red">Pendaftaran ditolak.</span><br><br> Anda bisa daftar ulang setelah <br> data diperbaiki.
                                    <?php endif; ?>
                                </p>
                            </div>

                            
                            <div class="dj-status-right">
                                <div class="status-progress-horizontal">

                                    
                                    <div class="step-item done">
                                        <div class="step-circle"></div>
                                        <div class="step-label">Pengajuan dikirim</div>
                                    </div>

                                    <div class="step-line"></div>

                                    
                                    <div class="step-item
                                        <?php if($status === 'pending'): ?> active <?php endif; ?>
                                        <?php if(in_array($status, ['approved','rejected'])): ?> done <?php endif; ?>
                                    ">
                                        <div class="step-circle"></div>
                                        <div class="step-label">Ditinjau admin</div>
                                    </div>

                                    <div class="step-line"></div>

                                    
                                    <div class="step-item
                                        <?php if($status === 'approved'): ?> approved active <?php endif; ?>
                                        <?php if($status === 'rejected'): ?> rejected active <?php endif; ?>
                                    ">
                                        <div class="step-circle"></div>
                                        <div class="step-label">
                                            <?php if($status === 'approved'): ?>
                                                Disetujui
                                            <?php elseif($status === 'rejected'): ?>
                                                Ditolak
                                            <?php else: ?>
                                                Menunggu
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                
                <?php if(!isset($registration) || !$registration): ?>

                    
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

                    
                    <section class="dj-form-wrapper">
                        <form action="<?php echo e(route('daftar-jasa.store')); ?>" method="POST" enctype="multipart/form-data" id="dj-multistep-form">
                            <?php echo csrf_field(); ?>

                            
                            <div class="dj-step-panel active" data-step="0">
                                <h4 class="dj-form-title">Informasi Pribadi</h4>

                                
                                <div class="dj-form-group">
                                    <label for="nama">Nama</label>
                                    <input
                                        id="nama"
                                        name="nama"
                                        type="text"
                                        placeholder="Masukkan nama lengkap"
                                        value="<?php echo e(auth()->user()->name); ?>"
                                        <?php echo e(auth()->user()->name ? 'readonly' : ''); ?>>
                                </div>

                                
                                <div class="dj-form-group">
                                    <label for="username">Username</label>
                                    <input
                                        id="username"
                                        name="username"
                                        type="text"
                                        placeholder="Nama pengguna"
                                        value="<?php echo e(auth()->user()->username); ?>"
                                        <?php echo e(auth()->user()->username ? 'readonly' : ''); ?>>
                                </div>

                                
                                <div class="dj-form-group">
                                    <label for="email">Email</label>
                                    <input
                                        id="email"
                                        name="email"
                                        type="email"
                                        placeholder="Email aktif"
                                        value="<?php echo e(auth()->user()->email); ?>"
                                        readonly>
                                </div>

                                
                                <div class="dj-form-group">
                                    <label for="telepon">No Telepon</label>
                                    <input
                                        id="telepon"
                                        name="telepon"
                                        type="text"
                                        placeholder="Nomor WhatsApp"
                                        value="<?php echo e(auth()->user()->telepon); ?>"
                                        <?php echo e(auth()->user()->telepon ? 'readonly' : ''); ?>>
                                </div>

                                
                                <div class="dj-form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea
                                        id="alamat"
                                        name="alamat"
                                        rows="3"
                                        placeholder="Tulis alamat lengkap"
                                        <?php echo e(auth()->user()->alamat ? 'readonly' : ''); ?>

                                    ><?php echo e(auth()->user()->alamat); ?></textarea>
                                </div>

                                <div class="dj-actions">
                                    <button type="button" class="dj-btn dj-btn-back dj-prev" disabled>BACK</button>
                                    <button type="button" class="dj-btn dj-btn-next dj-next">NEXT</button>
                                </div>
                            </div>

                            
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

                            
                            <div class="dj-step-panel" data-step="3">
                                <h4 class="dj-form-title">Verifikasi</h4>

                                <div class="dj-form-group">
                                    <label for="ktp">Upload KTP (opsional)</label>
                                    <input id="ktp" name="ktp" type="file" accept="image/*,application/pdf">
                                </div>

                                
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
                <?php endif; ?>
            </div>

            <p class="dj-footer-text">
                Isi data Anda dengan benar untuk memulai menjadi penyedia jasa di Jasain Aja
            </p>
        </div>
    </main>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <?php echo app('Illuminate\Foundation\Vite')('resources/js/daftar-jasa.js'); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\tubes_pemweb\JASAIN.AJA\resources\views/daftar-jasa.blade.php ENDPATH**/ ?>