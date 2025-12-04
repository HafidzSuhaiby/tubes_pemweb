<?php $__env->startSection('title', 'Edit Profil - Jasain Aja'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow-sm border-0 rounded-4 p-4">

                <h3 class="fw-bold mb-1">Edit Profil</h3>
                <p class="text-muted mb-4">Perbarui informasi akun kamu di sini.</p>

                
                <?php if(session('success')): ?>
                    <div class="alert alert-success small"><?php echo e(session('success')); ?></div>
                <?php endif; ?>

                
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger small">
                        <strong>Terjadi kesalahan:</strong>
                        <ul class="mt-2 mb-0 small">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="<?php echo e(route('profile.update')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="text-center mb-4">

                        
                        <div class="position-relative mx-auto" style="width:120px; height:120px;">

                            <?php if($user->photo_profile): ?>
                                <img id="img-preview"
                                     src="<?php echo e(asset('storage/uploads/foto_profile/' . $user->photo_profile)); ?>"
                                     class="rounded-circle border"
                                     style="width:120px; height:120px; object-fit:cover;">
                            <?php else: ?>
                                <div id="initials-placeholder"
                                     class="rounded-circle bg-light border d-flex align-items-center justify-content-center fw-bold text-secondary"
                                     style="width:120px; height:120px; font-size:48px;">
                                    <?php echo e(strtoupper(substr($user->name, 0, 1))); ?>

                                </div>
                            <?php endif; ?>

                        </div>

                        <label class="btn btn-outline-secondary btn-sm mt-3">
                            Ubah Foto
                            <input type="file" class="d-none" name="photo_profile" accept="image/*"
                                   onchange="previewImage(event)">
                        </label>

                        <div class="small text-muted mt-2">Format JPG/PNG, maksimal 2MB.</div>
                    </div>

                    <div class="row g-3">

                        
                        <div class="col-md-6">
                            <label class="form-label">Nama lengkap</label>
                            <input type="text" class="form-control"
                                   name="name" value="<?php echo e(old('name', $user->name)); ?>">
                        </div>

                        
                        <div class="col-md-6">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control"
                                   name="username" value="<?php echo e(old('username', $user->username)); ?>">
                        </div>

                        
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control"
                                   name="email" value="<?php echo e(old('email', $user->email)); ?>">
                        </div>

                        
                        <div class="col-md-6">
                            <label class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control"
                                   name="telepon" value="<?php echo e(old('telepon', $user->telepon)); ?>">
                        </div>

                        
                        <div class="col-12">
                            <label class="form-label">Alamat</label>
                            <textarea class="form-control" rows="3"
                                      name="alamat"><?php echo e(old('alamat', $user->alamat)); ?></textarea>
                        </div>

                    </div>

                    <hr class="my-4">

                    <h6 class="fw-bold mb-3">Ubah Password (opsional)</h6>

                    
                    <input type="text" name="fake_user" autocomplete="username" style="display:none;">
                    <input type="password" name="fake_pass" autocomplete="current-password" style="display:none;">

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label small">Password Baru</label>
                            <input type="password"
                                   name="password"
                                   class="form-control"
                                   autocomplete="new-password"
                                   placeholder="Biarkan kosong jika tidak diubah">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label small">Konfirmasi Password</label>
                            <input type="password"
                                   name="password_confirmation"
                                   class="form-control"
                                   autocomplete="new-password">
                        </div>

                    </div>

                    <div class="text-end mt-4">
                        <a href="<?php echo e(route('home')); ?>" class="btn btn-outline-secondary">Batal</a>
                        <button class="btn btn-primary px-4">Simpan Perubahan</button>
                    </div>

                </form>

            </div>

        </div>
    </div>

</div>


<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = e => {
            const img = document.getElementById('img-preview');
            const placeholder = document.getElementById('initials-placeholder');

            if (img) {
                img.src = e.target.result;
                img.style.display = 'block';
            }

            if (placeholder) {
                placeholder.style.display = 'none';
            }
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\tubes_pemweb\JASAIN.AJA\resources\views/profile/profile.blade.php ENDPATH**/ ?>