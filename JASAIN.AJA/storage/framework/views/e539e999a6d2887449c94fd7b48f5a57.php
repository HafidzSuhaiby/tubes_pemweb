<?php $__env->startSection('title', 'Daftar Pendaftar Jasa'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-white shadow rounded-lg p-6">

    
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-semibold text-gray-800 font-fredoka">
            Daftar Pendaftar Jasa
        </h1>
    </div>

    
    <?php if(session('success')): ?>
        <div class="mb-4 px-4 py-2 rounded-lg bg-green-100 text-green-700 text-sm">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="mb-4 px-4 py-2 rounded-lg bg-red-100 text-red-700 text-sm">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left font-medium text-gray-500">#</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-500">Pendaftar</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-500">Nama Jasa</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-500">Kategori</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-500">Lokasi</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-500">Status</th>
                    <th class="px-4 py-3 text-right font-medium text-gray-500">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100 bg-white">
                <?php $__empty_1 = true; $__currentLoopData = $registrations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        
                        <td class="px-4 py-3">
                            <?php echo e($index + 1); ?>

                        </td>

                        
                        <td class="px-4 py-3">
                            <div class="font-medium text-gray-800">
                                <?php echo e($r->user->name ?? '-'); ?>

                            </div>
                            <div class="text-gray-500 text-xs">
                                <?php echo e($r->user->email ?? '-'); ?>

                            </div>
                        </td>

                        
                        <td class="px-4 py-3">
                            <div class="font-medium text-gray-800">
                                <?php echo e($r->nama_jasa); ?>

                            </div>
                        </td>

                        
                        <td class="px-4 py-3 text-gray-700">
                            <?php echo e($r->kategori_label); ?>

                        </td>

                        
                        <td class="px-4 py-3 text-gray-700">
                            <?php echo e($r->kota ?? '-'); ?>

                        </td>

                        
                        <td class="px-4 py-3">
                            <?php if($r->status === 'pending'): ?>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">
                                    Sedang Ditinjau
                                </span>
                            <?php elseif($r->status === 'approved'): ?>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                    Disetujui
                                </span>
                            <?php else: ?>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                    Ditolak
                                </span>
                            <?php endif; ?>
                        </td>

                        
                        <td class="px-4 py-3">
                            <div class="flex justify-end">
                                <a href="<?php echo e(route('admin.pendaftar-jasa.show', $r->id)); ?>"
                                   class="px-3 py-1 text-xs rounded-lg bg-blue-500 text-white hover:bg-blue-600 flex items-center space-x-1">
                                    <i class="fa-solid fa-eye fa-sm"></i>
                                    <span>Tinjau</span>
                                </a>
                                
                                <?php if($r->status === 'rejected'): ?>
                                    <form action="<?php echo e(route('admin.pendaftar-jasa.destroy', $r->id)); ?>"
                                        method="POST"
                                        onsubmit="return confirm ('yakin menghapus pendaftaran ini?');">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button class="px-3 py-1 text-xs rounded bg-red-500 text-white">
                                        HAPUS
                                    </button>
                                </form>
                            <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td class="px-4 py-4 text-center text-gray-500" colspan="7">
                            Belum ada pendaftar jasa.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\tubes_pemweb\JASAIN.AJA\resources\views/admin_page/data_pendaftar_jasa/pendaftar_jasa.blade.php ENDPATH**/ ?>