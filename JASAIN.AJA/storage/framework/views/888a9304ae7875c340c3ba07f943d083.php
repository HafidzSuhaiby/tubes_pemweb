<?php $__env->startSection('title', 'Jasain Aja - Solusi Semua Jasa'); ?>

<?php $__env->startPush('styles'); ?>
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/jasa.css'); ?>
<?php $__env->stopPush(); ?>


<?php $__env->startPush('scripts'); ?>
    <?php echo app('Illuminate\Foundation\Vite')('resources/js/jasa.js'); ?>
<?php $__env->stopPush(); ?>



<?php $__env->startSection('banner'); ?>

<div class="banner-full">
    <div class="swiper mySwiper">

        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img src="<?php echo e(asset('images/banner1.png')); ?>" alt="">
            </div>

            <div class="swiper-slide">
                <img src="<?php echo e(asset('images/banner2.png')); ?>" alt="">
            </div>

            <div class="swiper-slide">
                <img src="<?php echo e(asset('images/banner3.png')); ?>" alt="">
            </div>
        </div>

        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>

    </div>
</div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

<div class="container py-5">

    <div class="text-center mb-5">
        <h1 class="fw-bold text-dark">Pilih Jasa Sesuai</h1>
        <p class="text-secondary fs-5">Kebutuhan Anda...</p>
    </div>

    
    <div class="d-flex flex-wrap justify-content-center gap-3 mb-4">

        <select id="filterKategori" class="form-select w-auto">
            <option value="">Semua Kategori</option>
            <?php $__currentLoopData = $kategoriList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($kategori); ?>"><?php echo e($kategori); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>

        <select id="filterArea" class="form-select w-auto">
            <option value="">Semua Area</option>
            <?php $__currentLoopData = $areaList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($area); ?>"><?php echo e($area); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>

        <button onclick="applyFilter()" class="btn btn-dark px-4">OK</button>

    </div>

    
    <?php if($services->count() > 0): ?>

        <div class="card-grid-wrapper">
            <div class="card-grid">

                <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <?php
                        // --- Ambil foto pertama ---
                        $raw = $service->foto_jasa_paths;
                        $foto = null;

                        if (is_array($raw)) {
                            $foto = $raw[0] ?? null;
                        } elseif (is_string($raw)) {
                            $decode = json_decode($raw, true);
                            if (json_last_error() === JSON_ERROR_NONE && is_array($decode)) {
                                $foto = $decode[0] ?? null;
                            } else {
                                $foto = $raw;
                            }
                        }

                        $fotoUrl = $foto ? asset("storage/$foto") : asset('images/jasa1.png');
                    ?>

                    <div class="card-item card shadow-sm border-0 h-100"
                         data-kategori="<?php echo e($service->kategori_label); ?>"
                         data-lokasi="<?php echo e($service->kota ?? ''); ?>"
                         style="background:#0f1b33; color:white;">

                        
                        <img src="<?php echo e($fotoUrl); ?>" class="card-img-top" alt="Foto Jasa">

                        <div class="card-body d-flex flex-column">

                            <h5 class="card-title fw-bold mb-1">
                                <?php echo e($service->nama_jasa); ?>

                            </h5>

                            <p class="card-text text-light mb-3" style="font-size: 0.9rem;">
                                <?php echo e(\Illuminate\Support\Str::limit($service->deskripsi, 80)); ?>

                            </p>

                            <p class="mb-1">
                                <strong>Lokasi:</strong> <?php echo e($service->kota ?? '-'); ?>

                            </p>

                            <p class="mb-1">
                                <strong>Operasional:</strong>
                                <?php echo e($service->jam_operasional ?? '-'); ?>

                            </p>

                            <p class="mb-3">
                                <strong>Harga Mulai:</strong>
                                <?php if($service->harga_mulai): ?>
                                    Rp <?php echo e(number_format($service->harga_mulai, 0, ',', '.')); ?>

                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </p>

                            <button
                                type="button"
                                class="btn btn-primary w-100 mt-auto btn-booking"
                                data-bs-toggle="modal"
                                data-bs-target="#bookingModal"
                                data-id="<?php echo e($service->id); ?>"
                                data-nama="<?php echo e($service->nama_jasa); ?>"
                                data-kategori="<?php echo e($service->kategori_label); ?>"
                                data-lokasi="<?php echo e($service->kota ?? '-'); ?>"
                                data-jam="<?php echo e($service->jam_operasional ?? '-'); ?>"
                                data-harga="<?php echo e($service->harga_mulai ?? ''); ?>"
                                data-foto="<?php echo e($fotoUrl); ?>"
                            >
                                Booking Sekarang
                            </button>

                        </div>
                    </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
        </div>

    
    <?php else: ?>
        <div class="d-flex justify-content-center align-items-center w-100" style="height: 40vh;">
            <p class="text-muted fs-5 m-0">Belum ada jasa yang tampil saat ini.</p>
        </div>
    <?php endif; ?>
</div>


<div class="modal fade" id="bookingModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Booking Jasa</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <div class="row g-4">

          
          <div class="col-md-5">
            <div class="border rounded p-3 h-100" style="background:#0f1b33; color:white;">
              <img id="modalJasaFoto" src="" alt="" class="img-fluid rounded mb-3">

              <h5 id="modalJasaNama" class="fw-bold mb-2"></h5>
              <p class="mb-1"><strong>Kategori:</strong> <span id="modalJasaKategori"></span></p>
              <p class="mb-1"><strong>Lokasi:</strong> <span id="modalJasaLokasi"></span></p>
              <p class="mb-1"><strong>Operasional:</strong> <span id="modalJasaJam"></span></p>
              <p class="mb-1">
                <strong>Harga Mulai:</strong>
                <span id="modalJasaHarga"></span>
              </p>
            </div>
          </div>

          
          <div class="col-md-7">
            <?php if(auth()->guard()->check()): ?>
            <form id="bookingForm" method="POST" action="<?php echo e(route('cart.add')); ?>">
              <?php echo csrf_field(); ?>
              <input type="hidden" name="service_id" id="bookingServiceId">

              <div class="mb-3">
                <label for="booking_date" class="form-label">Tanggal Booking</label>
                <input type="date" class="form-control" name="booking_date" id="booking_date" required>
              </div>

              <div class="mb-3">
                <label for="booking_time" class="form-label">Jam Booking</label>
                <input type="time" class="form-control" name="booking_time" id="booking_time" required>
              </div>

              <div class="mb-3">
                <label for="alamat" class="form-label">Alamat Lengkap</label>
                <textarea class="form-control" name="alamat" id="alamat" rows="3" required></textarea>
              </div>

              <div class="mb-3">
                <label for="catatan" class="form-label">Catatan Tambahan (opsional)</label>
                <textarea class="form-control" name="catatan" id="catatan" rows="2"></textarea>
              </div>

              <div class="d-flex justify-content-between align-items-center">

                <button type="submit" class="btn btn-primary">
                  Buat Pesanan
                </button>
              </div>
            </form>
            <?php else: ?>
              <p>Silakan <a href="<?php echo e(route('auth.show')); ?>">login</a> terlebih dahulu untuk melakukan booking.</p>
            <?php endif; ?>
          </div>

        </div>
      </div>

    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\tubes_pemweb\JASAIN.AJA\resources\views/jasa.blade.php ENDPATH**/ ?>