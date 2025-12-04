<?php $__env->startSection('title', 'Data Pesanan'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-6xl mx-auto py-6">

    
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">

        
        <div class="px-6 py-4 border-b border-gray-100">
            <h1 class="text-xl font-semibold text-gray-800">Data Pesanan</h1>
        </div>

        
        <?php if($orders->isEmpty()): ?>
            <div class="p-8 text-center text-gray-500 text-sm">
                Belum ada pesanan yang tercatat.
            </div>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-gray-700">
                    <thead class="bg-gray-50 text-xs font-semibold uppercase tracking-wide text-gray-500">
                        <tr>
                            <th class="px-6 py-3 text-left">#</th>
                            <th class="px-6 py-3 text-left">Pemesan</th>
                            <th class="px-6 py-3 text-left">Penyedia</th>
                            <th class="px-6 py-3 text-left">Jasa</th>
                            <th class="px-6 py-3 text-left">Jadwal</th>
                            <th class="px-6 py-3 text-left">Status</th>
                            <th class="px-6 py-3 text-left">Dibuat</th>
                            <th class="px-6 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $statusColors = [
                                'pending'    => 'bg-gray-100 text-gray-700',
                                'diterima'   => 'bg-blue-100 text-blue-700',
                                'diproses'   => 'bg-yellow-100 text-yellow-800',
                                'selesai'    => 'bg-green-100 text-green-700',
                                'dibatalkan' => 'bg-red-100 text-red-700',
                            ];
                        ?>

                        <tr class="border-t border-gray-100">
                            <td class="px-6 py-4"><?php echo e($orders->firstItem() + $index); ?></td>

                            
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-800"><?php echo e($order->user->name); ?></div>
                                <div class="text-xs text-gray-500"><?php echo e($order->user->email); ?></div>
                            </td>

                            
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-800"><?php echo e($order->provider->name); ?></div>
                                <div class="text-xs text-gray-500"><?php echo e($order->provider->email); ?></div>
                            </td>

                            
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-800"><?php echo e($order->service->nama_jasa); ?></div>
                                <div class="text-xs text-gray-500"><?php echo e($order->service->kategori_label); ?></div>
                            </td>

                            
                            <td class="px-6 py-4">
                                <?php echo e(\Carbon\Carbon::parse($order->booking_date)->format('d M Y')); ?><br>
                                <span class="text-xs text-gray-500"><?php echo e($order->booking_time); ?></span>
                            </td>

                            
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold <?php echo e($statusColors[$order->status]); ?>">
                                    <?php echo e($order->status_label); ?>

                                </span>
                            </td>

                            
                            <td class="px-6 py-4">
                                <?php echo e($order->created_at->format('d M Y')); ?><br>
                                <span class="text-xs text-gray-500"><?php echo e($order->created_at->format('H:i')); ?></span>
                            </td>

                            
                            <td class="px-6 py-4 text-right">
                                <a href="<?php echo e(route('admin.orders.show', $order)); ?>"
                                   class="inline-flex items-center px-3 py-1.5 rounded-full 
                                          text-xs font-semibold bg-blue-500 text-white
                                          hover:bg-blue-600 transition">
                                    <i class="fa-solid fa-eye fa-xs mr-1"></i>
                                    Detail
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            
            <div class="px-6 py-4 border-t border-gray-100">
                <?php echo e($orders->links()); ?>

            </div>
        <?php endif; ?>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\tubes_pemweb\JASAIN.AJA\resources\views/admin_page/data_pesanan/index.blade.php ENDPATH**/ ?>