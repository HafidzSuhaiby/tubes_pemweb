<?php $__env->startSection('title', 'Jasa Saya - Jasain Aja'); ?>

<?php $__env->startPush('styles'); ?>
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/daftar-jasa.css'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <main class="daftar-jasa-page">
        <div class="dj-container">
            <div class="dj-card">

                
                <aside class="dj-sidebar">
                    <button class="dj-step-btn active" type="button" data-tab-target="tab-info">
                        INFORMASI JASA
                    </button>
                    <button class="dj-step-btn" type="button" data-tab-target="tab-orders">
                        PESANAN SAYA
                    </button>
                </aside>

                
                <section class="dj-form-wrapper">

                    
                    <div class="my-service-tab active" id="tab-info">
                        <?php
                            $status = $registration->status;
                        ?>

                        <div class="my-service-header d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h2 class="my-service-title">Jasa Saya</h2>
                                <p class="my-service-sub">
                                    Detail jasa yang sudah kamu daftarkan di Jasain Aja.
                                </p>
                            </div>

                            
                            <div>
                                <?php if($status === 'approved'): ?>
                                    <span class="badge-status badge-status-approved">Disetujui</span>
                                <?php elseif($status === 'pending'): ?>
                                    <span class="badge-status badge-status-pending">Menunggu Review</span>
                                <?php else: ?>
                                    <span class="badge-status badge-status-rejected">Ditolak</span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <hr class="my-3">

                        
                        <section class="my-service-section">
                            <h5 class="my-service-section-title">Informasi Jasa</h5>

                            <div class="row g-3 my-service-info">
                                <div class="col-md-6">
                                    <p class="info-label">Nama Jasa</p>
                                    <p class="info-value"><?php echo e($registration->nama_jasa); ?></p>
                                </div>

                                <div class="col-md-6">
                                    <p class="info-label">Kategori</p>
                                    <p class="info-value"><?php echo e($registration->kategori_label); ?></p>
                                </div>

                                <div class="col-md-6">
                                    <p class="info-label">Kota</p>
                                    <p class="info-value"><?php echo e($registration->kota ?? '-'); ?></p>
                                </div>

                                <div class="col-md-6">
                                    <p class="info-label">Area Layanan</p>
                                    <p class="info-value"><?php echo e($registration->area_layanan ?? '-'); ?></p>
                                </div>

                                <div class="col-md-6">
                                    <p class="info-label">Hari Kerja</p>
                                    <p class="info-value"><?php echo e($registration->hari_kerja ?? '-'); ?></p>
                                </div>

                                <div class="col-md-6">
                                    <p class="info-label">Jam Operasional</p>
                                    <p class="info-value"><?php echo e($registration->jam_operasional ?? '-'); ?></p>
                                </div>

                                <div class="col-md-6">
                                    <p class="info-label">Harga Mulai</p>
                                    <p class="info-value">
                                        <?php if($registration->harga_mulai): ?>
                                            Rp <?php echo e(number_format($registration->harga_mulai, 0, ',', '.')); ?>

                                        <?php else: ?>
                                            -
                                        <?php endif; ?>
                                    </p>
                                </div>

                                <div class="col-12">
                                    <p class="info-label">Deskripsi</p>
                                    <p class="info-value">
                                        <?php echo e($registration->deskripsi ?: '-'); ?>

                                    </p>
                                </div>
                            </div>
                        </section>
                    </div>

                    
                        <div class="my-service-tab" id="tab-orders">
                            <div class="my-service-header mb-3">
                                <h2 class="my-service-title">Pesanan Saya</h2>
                                <p class="my-service-sub">
                                    Pesanan dari pengguna yang masuk ke jasa kamu.
                                </p>
                            </div>

                            <?php if(!$registration): ?>
                                <div class="my-service-empty">
                                    <i class="fa-regular fa-folder-open my-service-empty-icon"></i>
                                    <p class="my-service-empty-title">Belum ada jasa aktif</p>
                                    <p class="my-service-empty-sub">
                                        Daftarkan jasa terlebih dahulu untuk bisa menerima pesanan.
                                    </p>
                                </div>
                            <?php elseif($orders->isEmpty()): ?>
                                <div class="my-service-empty">
                                    <i class="fa-regular fa-folder-open my-service-empty-icon"></i>
                                    <p class="my-service-empty-title">Belum ada pesanan masuk</p>
                                    <p class="my-service-empty-sub">
                                        Pesanan dari pengguna akan muncul di sini begitu ada yang melakukan booking.
                                    </p>
                                </div>
                            <?php else: ?>
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
                                            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($index + 1); ?></td>
                                                    <td>
                                                        <?php echo e($order->user->name ?? 'User #' . $order->user_id); ?><br>
                                                        <small class="text-muted"><?php echo e($order->user->email ?? ''); ?></small>
                                                    </td>
                                                    <td>
                                                        <?php echo e(\Carbon\Carbon::parse($order->booking_date)->format('d M Y')); ?>

                                                        <?php echo e($order->booking_time); ?>

                                                    </td>
                                                    <td style="max-width: 240px;">
                                                        <small><?php echo e($order->alamat); ?></small>
                                                    </td>
                                                    <td>
                                                        <?php
                                                            $badgeClass = match($order->status) {
                                                                'pending'    => 'bg-secondary',
                                                                'diterima'   => 'bg-primary',
                                                                'diproses'   => 'bg-warning text-dark',
                                                                'selesai'    => 'bg-success',
                                                                'dibatalkan' => 'bg-danger',
                                                                default      => 'bg-secondary',
                                                            };
                                                        ?>
                                                        <span class="badge <?php echo e($badgeClass); ?>">
                                                            <?php echo e($order->status_label); ?>

                                                        </span>
                                                    </td>
                                                    <td>
                                                        <form method="POST" action="<?php echo e(route('orders.update-status', $order->id)); ?>" class="d-flex gap-2">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('PUT'); ?>
                                                            <select name="status" class="form-select form-select-sm">
                                                                <option value="pending"    <?php if($order->status === 'pending'): echo 'selected'; endif; ?>>Pending</option>
                                                                <option value="diterima"   <?php if($order->status === 'diterima'): echo 'selected'; endif; ?>>Diterima</option>
                                                                <option value="diproses"   <?php if($order->status === 'diproses'): echo 'selected'; endif; ?>>Diproses</option>
                                                                <option value="selesai"    <?php if($order->status === 'selesai'): echo 'selected'; endif; ?>>Selesai</option>
                                                                <option value="dibatalkan" <?php if($order->status === 'dibatalkan'): echo 'selected'; endif; ?>>Dibatalkan</option>
                                                            </select>
                                                            <button type="submit" class="btn btn-sm btn-dark">
                                                                Simpan
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif; ?>
                        </div>


                        
                    </div>

                </section>
            </div>
        </div>
    </main>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\tubes_pemweb\JASAIN.AJA\resources\views/jasa-saya.blade.php ENDPATH**/ ?>