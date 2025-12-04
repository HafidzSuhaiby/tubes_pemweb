<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?php echo $__env->yieldContent('title', 'Jasain Aja'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        crossorigin="anonymous" />

    
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/home.css', 'resources/js/home.js']); ?>

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>

<div class="d-flex flex-column min-vh-100 page-wrapper">

    
    <nav class="navbar navbar-expand-lg navbar-dark nav-main">
        <div class="container px-4 px-lg-5">

            
            <a class="navbar-brand d-flex align-items-center" href="<?php echo e(url('/home')); ?>">
                <img src="<?php echo e(asset('images/logo-jasain.png')); ?>" alt="Jasain Aja" class="logo-nav me-2">
                <div class="d-flex flex-column lh-1">
                    <span class="brand-title">JASAIN AJA</span>
                    <small class="brand-sub">Solusi Semua Jasa</small>
                </div>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarMain">
                <span class="navbar-toggler-icon"></span>
            </button>

            
            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center gap-lg-3">

                    <?php if(auth()->guard()->check()): ?>
                        <?php
                            $user = auth()->user();
                            $role = optional($user->role)->nama_role;
                        ?>

                        
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->is('home') ? 'active' : ''); ?>"
                               href="<?php echo e(url('/home')); ?>">Home</a>
                        </li>

                        
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->is('tentang') ? 'active' : ''); ?>"
                               href="<?php echo e(url('/tentang')); ?>">Tentang Kami</a>
                        </li>

                        
                        <?php if($role === 'penyedia'): ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo e(request()->is('jasa-saya') ? 'active' : ''); ?>"
                                   href="<?php echo e(route('jasa-saya')); ?>">
                                    Jasa Saya
                                </a>
                            </li>

                        
                        <?php elseif($role === 'pelanggan'): ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo e(request()->is('jasa') ? 'active' : ''); ?>"
                                   href="<?php echo e(url('/jasa')); ?>">Jasa</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link <?php echo e(request()->is('daftar-jasa') ? 'active' : ''); ?>"
                                   href="<?php echo e(route('daftar-jasa')); ?>">Daftar Jasa</a>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>


                    
                    <?php if(auth()->guard()->guest()): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->is('home') ? 'active' : ''); ?>"
                               href="<?php echo e(url('/home')); ?>">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->is('tentang') ? 'active' : ''); ?>"
                               href="<?php echo e(url('/tentang')); ?>">Tentang Kami</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->is('jasa') ? 'active' : ''); ?>"
                               href="<?php echo e(url('/jasa')); ?>">Jasa</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request()->is('daftar-jasa') ? 'active' : ''); ?>"
                               href="<?php echo e(url('/daftar-jasa')); ?>">Daftar Jasa</a>
                        </li>
                    <?php endif; ?>


                    
                    <?php if(auth()->guard()->check()): ?>

                        
                        <?php if($role === 'pelanggan' && request()->is('jasa')): ?>
                            <li class="nav-item d-flex align-items-center">
                                <a href="<?php echo e(route('cart.index')); ?>"
                                   class="nav-link position-relative d-flex align-items-center">
                                    <i class="fa-solid fa-cart-shopping fa-lg text-white"></i>
                                    
                                    
                                </a>
                            </li>
                        <?php endif; ?>

                        
                        <li class="nav-item dropdown">
                            <button class="btn btn-link nav-link dropdown-toggle d-flex align-items-center gap-2"
                                    data-bs-toggle="dropdown" type="button">

                                <img
                                    src="<?php echo e(Auth::user()->photo_profile
                                        ? asset('storage/uploads/foto_profile/' . Auth::user()->photo_profile)
                                        : 'https://placehold.co/40x40/E2E8F0/718096?text=' . strtoupper(substr(Auth::user()->name, 0, 1))); ?>"
                                    alt="Profile"
                                    class="rounded-circle"
                                    width="32" height="32">

                                <span class="fw-medium"><?php echo e(Auth::user()->name); ?></span>
                            </button>

                            <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3 p-2"
                                style="min-width: 230px;">

                                
                                <li>
                                    <a class="dropdown-item d-flex align-items-center gap-2 py-2"
                                       href="<?php echo e(route('profile.edit')); ?>">
                                        <i class="fa-solid fa-user text-muted"></i>
                                        <span class="small">My Profile</span>
                                    </a>
                                </li>

                                
                                <?php if($role === 'pelanggan'): ?>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-2 py-2"
                                           href="<?php echo e(route('booking')); ?>">
                                            <i class="fa-solid fa-clipboard-list text-muted"></i>
                                            <span class="small">Pesanan Saya</span>
                                        </a>
                                    </li>
                                <?php endif; ?>

                                <li><hr class="dropdown-divider my-2"></li>

                                
                                <li>
                                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit"
                                                class="dropdown-item d-flex align-items-center gap-2 py-2">
                                            <i class="fa-solid fa-right-from-bracket text-muted"></i>
                                            <span class="small">Logout</span>
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>

                    <?php endif; ?>


                    
                    <?php if(auth()->guard()->guest()): ?>
                        <li class="nav-item ms-lg-3">
                            <a href="<?php echo e(route('auth.show')); ?>"
                               class="btn btn-outline-light btn-sm">
                                <i class="fa-solid fa-right-to-bracket me-1"></i> Login
                            </a>
                        </li>
                    <?php endif; ?>

                </ul>
            </div>

        </div>
    </nav>


    <main class="flex-grow-1">
        <?php echo $__env->yieldContent('banner'); ?>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <?php echo $__env->make('layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH D:\laragon\www\tubes_pemweb\JASAIN.AJA\resources\views/layouts/main.blade.php ENDPATH**/ ?>