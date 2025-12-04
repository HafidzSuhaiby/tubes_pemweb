<?php $__env->startSection('title', 'Jasain Aja - Solusi Semua Jasa'); ?>

<?php $__env->startSection('content'); ?>
    
    <main class="hero-section position-relative flex-grow-1"
          style="background-image: url('<?php echo e(asset('images/hero-bg.jpeg')); ?>');">

        <div class="hero-overlay"></div>

        <div class="container h-100 position-relative">
            <div class="row h-100 align-items-center py-5">

                
                <div class="col-lg-6 text-white hero-text">
                    <h1 class="hero-title fw-bold mb-3">
                        Butuh Jasa?<br>
                        Semua Ada di Sini
                    </h1>

                    <p class="hero-subtext mb-4">
                        “Temukan layanan terbaik dari penyedia jasa profesional yang terverifikasi,
                        dengan kualitas terjamin untuk mendukung kebutuhan pribadi maupun bisnis Anda.”
                    </p>

                    <div class="d-flex flex-wrap gap-3 justify-content-end">
                        <a href="#" id="btnCariJasa" class="btn btn-primary px-4 py-2">
                            Cari Jasa
                        </a>
                        <a href="#" id="btnDaftarJasa" class="btn btn-primary px-4 py-2">
                            Daftar Jasa
                        </a>
                    </div>

                </div>

                
                <div class="col-lg-6 d-flex justify-content-lg-end justify-content-center mt-5 mt-lg-0">

                    <div class="position-relative d-flex justify-content-center align-items-center"
                         style="width: 520px; height: 580px;">

                        
                        <svg viewBox="0 0 658 685"
                             class="position-absolute w-100 h-100 z-10"
                             style="pointer-events: none;">
                            <path d="M68.1846 492.779C-52.5763 481.132 -1.53033 393.135 132.155 131.732C265.841 -129.672 450.703 78.6746 450.703 78.6746C450.703 78.6746 466.369 208.729 611.935 289.609C757.501 370.489 515.979 578.188 466.369 601.481C416.759 624.774 313.623 661.656 230.722 652.597C147.822 643.539 188.946 504.425 68.1846 492.779Z"
                                  fill="#1F3C88" />
                        </svg>

                        
                        <img src="<?php echo e(asset('images/oranghome.png')); ?>"
                            alt="pekerja"
                            class="position-relative img-fluid z-20"
                            style="width: 75%; height: auto; transform: translateY(-40px);">
                    </div>

                </div>

            </div>
        </div>
    </main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\tubes_pemweb\JASAIN.AJA\resources\views/home.blade.php ENDPATH**/ ?>