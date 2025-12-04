<?php $__env->startSection('title', 'Pesanan Saya - Jasain Aja'); ?>

<?php $__env->startPush('styles'); ?>
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
<?php $__env->stopPush(); ?>



<?php $__env->startSection('content'); ?>
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

                <?php if($orders->isEmpty()): ?>
                    <div class="text-center py-5">
                        <i class="fa-regular fa-folder-open fa-3x mb-3 text-muted"></i>
                        <h5 class="mb-1">Belum ada pesanan</h5>
                        <p class="text-muted mb-0">
                            Yuk mulai pesan jasa di halaman <a href="<?php echo e(route('jasa.index')); ?>">Jasa</a>.
                        </p>
                    </div>
                <?php else: ?>
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
                            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $badgeClass = match($order->status) {
                                        'pending'    => 'bg-secondary text-white',
                                        'diterima'   => 'bg-primary text-white',
                                        'diproses'   => 'bg-warning text-dark',
                                        'selesai'    => 'bg-success text-white',
                                        'dibatalkan' => 'bg-danger text-white',
                                        default      => 'bg-secondary text-white',
                                    };
                                ?>
                                <tr>
                                    <td><?php echo e($index + 1); ?></td>
                                    <td>
                                        <?php echo e($order->service->nama_jasa ?? '-'); ?><br>
                                        <small class="text-muted">
                                            <?php echo e($order->service->kategori_label ?? ''); ?>

                                        </small>
                                    </td>
                                    <td>
                                        <?php echo e($order->provider->name ?? 'Penyedia #' . $order->provider_id); ?><br>
                                        <small class="text-muted">
                                            <?php echo e($order->provider->email ?? ''); ?>

                                        </small>
                                    </td>
                                    <td>
                                        <?php echo e(\Carbon\Carbon::parse($order->booking_date)->format('d M Y')); ?><br>
                                        <small class="text-muted"><?php echo e($order->booking_time); ?></small>
                                    </td>
                                    <td style="max-width: 240px;">
                                        <small><?php echo e($order->alamat); ?></small>
                                    </td>
                                    <td>
                                        <span class="status-badge <?php echo e($badgeClass); ?>">
                                            <?php echo e($order->status_label); ?>

                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>

            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\tubes_pemweb\JASAIN.AJA\resources\views/booking.blade.php ENDPATH**/ ?>