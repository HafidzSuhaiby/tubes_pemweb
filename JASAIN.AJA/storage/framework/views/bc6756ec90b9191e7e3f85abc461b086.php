<?php $__env->startSection('title', 'Data Pengguna'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-white shadow rounded-lg p-6">

    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-semibold text-gray-800 font-fredoka">
            Data Pengguna
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
                    <th class="px-4 py-3 text-left font-medium text-gray-500">Nama</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-500">Email</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-500">Role</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-500">Dibuat</th>
                    <th class="px-4 py-3 text-right font-medium text-gray-500">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 bg-white">
                <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="px-4 py-3">
                            <?php echo e($users->firstItem() + $index); ?>

                        </td>

                        <td class="px-4 py-3">
                            <span class="font-medium text-gray-800">
                                <?php echo e($user->name); ?>

                            </span>
                        </td>

                        <td class="px-4 py-3 text-gray-700">
                            <?php echo e($user->email); ?>

                        </td>

                        <td class="px-4 py-3 text-gray-700">
                            <?php echo e(optional($user->role)->nama_role ?? '–'); ?>

                        </td>

                        <td class="px-4 py-3 text-gray-500">
                            <?php echo e($user->created_at?->format('d M Y')); ?>

                        </td>

                        <td class="px-4 py-3">
                            <div class="flex justify-end space-x-2">

                                
                                <a href="<?php echo e(route('admin.users.edit', $user)); ?>"
                                   class="px-3 py-1 text-xs bg-yellow-400 text-white rounded-lg
                                          hover:bg-yellow-500 flex items-center space-x-1">
                                    <i class="fa-solid fa-pen-to-square fa-sm"></i>
                                    <span>Edit</span>
                                </a>

                                
                                <form action="<?php echo e(route('admin.users.destroy', $user)); ?>"
                                      method="POST"
                                      onsubmit="return confirm('Yakin menghapus pengguna ini?');">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit"
                                            class="px-3 py-1 text-xs bg-red-500 text-white rounded-lg
                                                   hover:bg-red-600 flex items-center space-x-1">
                                        <i class="fa-solid fa-trash fa-sm"></i>
                                        <span>Hapus</span>
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td class="px-4 py-4 text-center text-gray-500" colspan="6">
                            Belum ada data pengguna.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        <?php echo e($users->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\tubes_pemweb\JASAIN.AJA\resources\views/admin_page/user_data/user_data.blade.php ENDPATH**/ ?>