

<?php $__env->startSection('title', 'Detail Pesanan #' . $order->id); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto py-6">

    
    <div class="mb-4">
        <a href="<?php echo e(route('admin.orders.index')); ?>" class="text-blue-600 hover:text-blue-800 text-sm font-semibold inline-flex items-center gap-2">
            <i class="fas fa-arrow-left"></i> Kembali ke Data Pesanan
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        
        
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50">
            <h1 class="text-xl font-semibold text-gray-800">Detail Pesanan #<?php echo e($order->id); ?></h1>
            
            
            <?php
                $colors = [
                    'pending' => 'bg-gray-200 text-gray-700',
                    'diterima' => 'bg-blue-100 text-blue-700',
                    'diproses' => 'bg-yellow-100 text-yellow-800',
                    'selesai' => 'bg-green-100 text-green-700',
                    'dibatalkan' => 'bg-red-100 text-red-700',
                ];
                $colorClass = $colors[$order->status] ?? 'bg-gray-100 text-gray-700';
            ?>
            <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide <?php echo e($colorClass); ?>">
                <?php echo e($order->status); ?>

            </span>
        </div>

        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-8">
            
            
            <div>
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-4 border-b pb-2">Informasi Jasa</h3>
                <div class="space-y-4">
                    <div>
                        <p class="text-sm text-gray-500">Nama Jasa</p>
                        <p class="font-bold text-gray-800 text-lg"><?php echo e($order->service->nama_jasa ?? '-'); ?></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Kategori</p>
                        <p class="font-medium text-gray-700"><?php echo e($order->service->kategori ?? '-'); ?></p>
                    </div>
                    <div class="bg-blue-50 p-3 rounded-lg border border-blue-100">
                        <p class="text-sm text-blue-500 mb-1">Jadwal Booking</p>
                        <div class="flex items-center gap-2 text-blue-800 font-semibold">
                            <i class="far fa-calendar"></i>
                            <span><?php echo e(\Carbon\Carbon::parse($order->booking_date)->format('d F Y')); ?></span>
                            <span class="mx-1">|</span>
                            <i class="far fa-clock"></i>
                            <span><?php echo e($order->booking_time); ?></span>
                        </div>
                    </div>
                </div>
            </div>

            
            <div>
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-4 border-b pb-2">Informasi Pembayaran</h3>
                <div class="p-4 bg-gray-50 rounded-xl border border-gray-100">
                    <div class="flex justify-between items-center mb-3">
                        <span class="text-sm text-gray-500">Total Harga</span>
                        <span class="font-bold text-green-600 text-xl">
                            Rp <?php echo e(number_format($order->service->harga_mulai ?? 0, 0, ',', '.')); ?>

                        </span>
                    </div>

                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm text-gray-500">Metode</span>
                        <span class="font-medium text-gray-700 uppercase bg-white px-2 py-1 rounded border text-xs">
                            <?php echo e($order->payment_method ?? 'Cash'); ?>

                        </span>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">Status Bayar</span>
                        <span class="font-bold text-xs uppercase px-2 py-1 rounded <?php echo e($order->payment_status == 'paid' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'); ?>">
                            <?php echo e($order->payment_status ?? 'Unpaid'); ?>

                        </span>
                    </div>
                </div>
            </div>

            
            <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-gray-100">
                
                
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center text-gray-500 flex-shrink-0">
                        <i class="fas fa-user"></i>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-gray-800">Pemesan</h4>
                        <p class="text-gray-600"><?php echo e($order->user->name ?? 'User Terhapus'); ?></p>
                        <p class="text-xs text-gray-400"><?php echo e($order->user->email ?? '-'); ?></p>
                        <?php if($order->user->telepon): ?>
                            <p class="text-xs text-green-600 mt-1"><i class="fab fa-whatsapp"></i> <?php echo e($order->user->telepon); ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-store"></i>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-gray-800">Penyedia Jasa</h4>
                        <p class="text-gray-600"><?php echo e($order->provider->name ?? 'Provider Terhapus'); ?></p>
                        <p class="text-xs text-gray-400"><?php echo e($order->provider->email ?? '-'); ?></p>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\tubes_pemweb\JASAIN.AJA\resources\views/admin_page/data_pesanan/show.blade.php ENDPATH**/ ?>