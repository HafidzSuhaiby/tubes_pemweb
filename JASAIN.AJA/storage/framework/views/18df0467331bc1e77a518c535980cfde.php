<?php $__env->startSection('title', 'Pilih Metode Pembayaran'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body">
                    <h3 class="mb-1">Pilih Metode Pembayaran</h3>

                    <p class="text-dark mb-4" style="opacity:.8;">
                        Total yang harus dibayar:
                        <strong>Rp <?php echo e(number_format($total, 0, ',', '.')); ?></strong>
                    </p>

                    
                    <form method="POST" action="<?php echo e(route('payment.method')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="mb-3">
                            <label for="payment_method" class="form-label">Metode Pembayaran</label>
                            <select name="payment_method" id="payment_method" class="form-select" required>
                                <option value="dana">DANA</option>
                                <option value="gopay">GoPay</option>
                                <option value="ovo">OVO</option>
                                <option value="cash">Cash / Bayar Langsung</option>
                            </select>
                        </div>

                        <p class="text-muted small mb-3">
                            • Jika memilih <strong>Cash</strong>, pesanan akan langsung dibuat tanpa QR.<br>
                            • Jika memilih <strong>DANA / GoPay / OVO</strong>, kamu akan melihat QR untuk discan.
                        </p>

                        <button type="submit" class="btn btn-primary w-100">
                            Lanjutkan
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\tubes_pemweb\JASAIN.AJA\resources\views/payment/select.blade.php ENDPATH**/ ?>