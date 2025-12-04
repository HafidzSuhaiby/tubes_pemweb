<?php $__env->startSection('title', 'Tinjau Pendaftar Jasa'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-white shadow rounded-lg p-6">

    <h1 class="text-2xl font-semibold mb-6">Tinjau Pendaftar Jasa</h1>

    
    <div class="mb-6">
        <h2 class="text-lg font-semibold mb-2">Informasi Pribadi</h2>
        <div class="space-y-1 text-gray-700">
            <p><strong>Nama:</strong> <?php echo e($reg->user->name); ?></p>
            <p><strong>Email:</strong> <?php echo e($reg->user->email); ?></p>
            <p><strong>Username:</strong> <?php echo e($reg->user->username); ?></p>
            <p><strong>Telepon:</strong> <?php echo e($reg->user->telepon); ?></p>
            <p><strong>Alamat:</strong> <?php echo e($reg->user->alamat); ?></p>
        </div>
    </div>

    
    <div class="mb-6">
        <h2 class="text-lg font-semibold mb-2">Informasi Jasa</h2>
        <div class="space-y-1 text-gray-700">
            <p><strong>Nama Jasa:</strong> <?php echo e($reg->nama_jasa); ?></p>
            <p><strong>Kategori:</strong> <?php echo e($reg->kategori_label); ?></p>
            <p><strong>Deskripsi:</strong> <?php echo e($reg->deskripsi); ?></p>
            <p><strong>Pengalaman:</strong> <?php echo e($reg->pengalaman); ?> tahun</p>
            <p><strong>Harga Mulai:</strong> Rp <?php echo e(number_format($reg->harga_mulai,0,',','.')); ?></p>
        </div>
    </div>

    
    <div class="mb-6">
        <h2 class="text-lg font-semibold mb-2">Lokasi dan Waktu</h2>
        <div class="space-y-1 text-gray-700">
            <p><strong>Kota:</strong> <?php echo e($reg->kota); ?></p>
            <p><strong>Area Layanan:</strong> <?php echo e($reg->area_layanan); ?></p>
            <p><strong>Hari Kerja:</strong> <?php echo e($reg->hari_kerja); ?></p>
            <p><strong>Jam Operasional:</strong> <?php echo e($reg->jam_operasional); ?></p>
        </div>
    </div>

    
    <div class="mb-6">
        <h2 class="text-lg font-semibold mb-2">Verifikasi Berkas</h2>

        
        <?php if($reg->ktp_path): ?>
            <p><strong>KTP:</strong></p>
            <a href="<?php echo e(asset('storage/'.$reg->ktp_path)); ?>" 
            target="_blank" class="text-blue-500 underline">
                Lihat KTP
            </a>
        <?php else: ?>
            <p class="text-gray-500">Tidak ada KTP</p>
        <?php endif; ?>


        
        <?php
            $portosRaw = $reg->portofolio_paths ?? [];
            $portos = [];

            if (is_array($portosRaw)) {
                $portos = $portosRaw;
            } elseif (is_string($portosRaw) && $portosRaw !== '') {
                $decoded = json_decode($portosRaw, true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    $portos = $decoded;
                } else {
                    $portos = [$portosRaw];
                }
            }
        ?>

        <?php if(!empty($portos)): ?>
            <p class="mt-4"><strong>Portofolio:</strong></p>
            <div class="flex space-x-3 mt-2">
                <?php $__currentLoopData = $portos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $porto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <img src="<?php echo e(asset('storage/'.$porto)); ?>" 
                        class="w-24 h-24 object-cover rounded border">
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <p class="text-gray-500 mt-4">Tidak ada portofolio</p>
        <?php endif; ?>


        
        <div class="mt-3">
            <p><strong>Foto Jasa:</strong></p>

            <?php
                $fotosRaw = $reg->foto_jasa_paths;
                $fotos = [];

                if (is_array($fotosRaw)) {
                    $fotos = $fotosRaw;
                } elseif (is_string($fotosRaw) && $fotosRaw !== '') {
                    $decoded = json_decode($fotosRaw, true);
                    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                        $fotos = $decoded;
                    } else {
                        $fotos = [$fotosRaw];
                    }
                }
            ?>

            <?php if(!empty($fotos)): ?>
                <div class="flex space-x-3 mt-2">
                    <?php $__currentLoopData = $fotos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $foto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <img src="<?php echo e(asset('storage/'.$foto)); ?>"
                            class="w-24 h-24 object-cover rounded border">
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <p class="text-gray-500">Tidak ada foto jasa</p>
            <?php endif; ?>
        </div>
    </div>

    
    <div class="flex space-x-2 mt-6">
        <form action="<?php echo e(route('admin.pendaftar-jasa.approve', $reg->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <button class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">
                ✔ Setujui
            </button>
        </form>

        <form action="<?php echo e(route('admin.pendaftar-jasa.reject', $reg->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <button class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                ✖ Tolak
            </button>
        </form>

        <a href="<?php echo e(route('admin.pendaftar-jasa')); ?>"
           class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400">
           ← Kembali
        </a>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\tubes_pemweb\JASAIN.AJA\resources\views/admin_page/data_pendaftar_jasa/pendaftar_jasa_show.blade.php ENDPATH**/ ?>