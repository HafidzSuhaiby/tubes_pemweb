<?php $__env->startSection('title', 'Daftar Jasa Disetujui'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-white shadow rounded-lg p-6">

    
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-semibold text-gray-800 font-fredoka">
            Daftar Jasa Disetujui
        </h1>

        
        
    </div>

    
    <?php if(session('success')): ?>
        <div class="mb-4 p-3 rounded bg-green-100 text-green-800 text-sm">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
                <tr class="text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    <th class="px-4 py-3 text-left">#</th>
                    <th class="px-4 py-3 text-left">Penyedia</th>
                    <th class="px-4 py-3 text-left">Nama Jasa</th>
                    <th class="px-4 py-3 text-left">Kategori</th>
                    <th class="px-4 py-3 text-left">Kota</th>
                    <th class="px-4 py-3 text-left">Harga Mulai</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-left">Tampil</th>
                    <th class="px-4 py-3 text-left">Aksi</th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-100">
                <?php $__empty_1 = true; $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-gray-50">
                        
                        <td class="px-4 py-3">
                            <?php echo e($loop->iteration + ($services->currentPage() - 1) * $services->perPage()); ?>

                        </td>

                        
                        <td class="px-4 py-3 font-medium text-gray-800">
                            <?php echo e($service->user->name ?? '-'); ?>

                        </td>

                        
                        <td class="px-4 py-3">
                            <?php echo e($service->nama_jasa); ?>

                        </td>

                        
                        <td class="px-4 py-3">
                            <?php echo e($service->kategori_label); ?>

                        </td>

                        
                        <td class="px-4 py-3">
                            <?php echo e($service->kota ?? '-'); ?>

                        </td>

                        
                        <td class="px-4 py-3">
                            <?php if($service->harga_mulai): ?>
                                Rp <?php echo e(number_format($service->harga_mulai, 0, ',', '.')); ?>

                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </td>
                        
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                Disetujui
                            </span>
                        </td>

                        
                        <td class="px-4 py-3">
                            <?php if($service->is_active): ?>
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                    Aktif
                                </span>
                            <?php else: ?>
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-200 text-gray-700">
                                    Disembunyikan
                                </span>
                            <?php endif; ?>
                        </td>

                        
                        <td class="px-4 py-3">
                            <form action="<?php echo e(route('admin.data-jasa.toggle', $service->id)); ?>" method="POST" class="inline-block">
                                <?php echo csrf_field(); ?>
                                <button type="submit"
                                    class="inline-flex items-center px-3 py-1 rounded text-xs font-medium
                                        <?php echo e($service->is_active ? 'bg-red-500 hover:bg-red-600 text-white' : 'bg-green-500 hover:bg-green-600 text-white'); ?>">
                                    <?php echo e($service->is_active ? 'Sembunyikan di Halaman' : 'Tampilkan di Halaman'); ?>

                                </button>
                            </form>
                        </td>


                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="8" class="px-4 py-4 text-center text-gray-500">
                            Belum ada jasa yang disetujui.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    
    <div class="mt-4">
        <?php echo e($services->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\tubes_pemweb\JASAIN.AJA\resources\views/admin_page/data_jasa/data_jasa.blade.php ENDPATH**/ ?>