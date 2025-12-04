<?php $__env->startSection('title', 'Keranjang Saya'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .cart-card {
        border-radius: 20px;
        border: none;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-lg-10">

            
            <div class="card cart-card shadow-lg">
                <div class="card-body">

                    
                    <h2 class="fw-bold mb-1">Keranjang Pesanan</h2>
                    <p class="text-dark mb-4" style="opacity: .8;">
                        Pilih pesanan yang ingin kamu checkout terlebih dahulu.
                    </p>

                    <?php if($carts->isEmpty()): ?>

                        <div class="text-center py-5">
                            <i class="fa-regular fa-folder-open fa-3x mb-3 text-muted"></i>
                            <h5 class="mb-1">Keranjang masih kosong</h5>
                            <p class="text-muted mb-0">
                                Yuk cari jasa di halaman <a href="<?php echo e(route('jasa.index')); ?>">Jasa</a>.
                            </p>
                        </div>

                    <?php else: ?>

                        
                        <form method="POST" action="<?php echo e(route('cart.checkout')); ?>">
                            <?php echo csrf_field(); ?>

                            <div class="table-responsive mb-4">
                                <table class="table align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-center" style="width: 40px;">
                                                <input type="checkbox" id="checkAll">
                                            </th>
                                             
                                            <th>Jasa</th>
                                            <th>Penyedia</th>
                                            <th>Jadwal</th>
                                            <th>Alamat</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    <?php $__currentLoopData = $carts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="text-center">
                                                <input type="checkbox"
                                                    name="cart_ids[]"
                                                    value="<?php echo e($item->id); ?>"
                                                    class="form-check-input cart-checkbox">
                                            </td>

                                            <td>
                                                <strong><?php echo e($item->service->nama_jasa ?? '-'); ?></strong><br>
                                                <small class="text-muted">
                                                    <?php echo e($item->service->kategori_label ?? ''); ?>

                                                </small>
                                            </td>

                                            <td>
                                                <?php echo e($item->provider->name ?? 'Penyedia #' . $item->provider_id); ?><br>
                                                <small class="text-muted">
                                                    <?php echo e($item->provider->email ?? ''); ?>

                                                </small>
                                            </td>

                                            <td>
                                                <?php echo e(\Carbon\Carbon::parse($item->booking_date)->format('d M Y')); ?><br>
                                                <small class="text-muted"><?php echo e($item->booking_time); ?></small>
                                            </td>

                                            <td style="max-width: 260px;">
                                                <small><?php echo e($item->alamat); ?></small>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>

                            
                            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">

                                <div class="small text-dark">
                                    Total item di keranjang: <strong><?php echo e($carts->count()); ?></strong><br>
                                    <span id="selected-count">Dipilih: 0</span>
                                </div>

                                <button type="submit" class="btn btn-primary px-4">
                                    Checkout Pesanan Terpilih
                                </button>
                            </div>

                        </form>
                    <?php endif; ?>

                </div>
            </div>

        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\tubes_pemweb\JASAIN.AJA\resources\views/cart/index.blade.php ENDPATH**/ ?>