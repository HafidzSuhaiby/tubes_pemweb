<?php $__env->startSection('title', 'Bayar Pesanan'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-lg border-0 rounded-4 text-center">
                <div class="card-body">
                    <h3 class="mb-2">Konfirmasi Pembayaran</h3>
                    <p class="text-dark mb-4" style="opacity:.8;">
                        Total yang akan dibayar:
                        <strong>Rp <?php echo e(number_format($total, 0, ',', '.')); ?></strong>
                    </p>

                    <p class="text-muted small mb-3">
                        Ini hanya simulasi. Tekan tombol di bawah untuk menandai bahwa
                        kamu sudah melakukan pembayaran.
                    </p>

                    <form method="POST" action="<?php echo e(route('payment.confirm', $token)); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-success w-100">
                            Bayar Sekarang (Simulasi)
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\tubes_pemweb\JASAIN.AJA\resources\views/payment/pay-page.blade.php ENDPATH**/ ?>