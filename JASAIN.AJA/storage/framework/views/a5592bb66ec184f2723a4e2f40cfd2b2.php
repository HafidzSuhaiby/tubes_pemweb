<?php $__env->startSection('title', 'Tentang Kami - Jasain Aja (Premium)'); ?>

<?php $__env->startSection('content'); ?>


<style>
    body {
        background: #0f1b33 !important;
        color: white !important;
        font-family: "Poppins", sans-serif;
    }

    /* ===== HERO PREMIUM ===== */
    .about-hero {
        width: 100vw;
        position: relative;
        left: 50%;
        right: 50%;
        margin-left: -50vw;
        padding: 120px 20px;
        text-align: center;
        background: linear-gradient(135deg, #0b1e4a, #08305f, #021425);
        background-size: 200% 200%;
        animation: gradientFloat 6s ease infinite;
        border-radius: 0 0 35px 35px;
        box-shadow: 0 15px 30px rgba(0,0,0,0.35);
    }

    @keyframes gradientFloat {
        0% { background-position: 0% 30%; }
        50% { background-position: 100% 70%; }
        100% { background-position: 0% 30%; }
    }

    .about-hero h1 {
        font-size: 52px;
        font-weight: 900;
        opacity: 0;
        animation: fadeUp .9s ease forwards .2s;
    }

    .about-hero h2 {
        font-size: 38px;
        margin-top: -10px;
        font-weight: 700;
        opacity: 0;
        animation: fadeUp 1s ease forwards .4s;
    }

    .about-hero p {
        max-width: 780px;
        font-size: 19px;
        margin: 20px auto 0;
        line-height: 1.7;
        opacity: 0;
        animation: fadeUp 1s ease forwards .6s;
    }

    @keyframes fadeUp {
        0% { opacity: 0; transform: translateY(25px); }
        100% { opacity: 1; transform: translateY(0); }
    }

    .section-block {
        padding: 90px 20px;
        text-align: center;
        position: relative;
    }

    .section-block h2 {
        font-size: 36px;
        font-weight: 800;
        margin-bottom: 14px;
        opacity: 0;
        animation: fadeUp .8s ease forwards;
    }

    .section-desc {
        font-size: 17px;
        opacity: .75;
        max-width: 700px;
        margin: 0 auto 40px;
    }

    .mission-vision {
        display: flex;
        justify-content: center;
        gap: 120px;
        margin-top: 40px;
        flex-wrap: wrap;
        text-align: left;
    }

    .mission-vision div {
        max-width: 380px;
        opacity: 0;
        animation: fadeUp 1s ease forwards;
    }

    .story-text {
        max-width: 900px;
        margin: 0 auto;
        opacity: .78;
        line-height: 1.8;
    }

    /* ===== TEAM (NORMAL IMAGE) ===== */
    .team-wrapper {
        display: flex;
        justify-content: center;
        gap: 110px;
        margin-top: 70px;
        flex-wrap: wrap;
    }

    .team-card {
        width: 220px;
        text-align: center;
        opacity: 1 !important; /* Fix miring */
    }

    .team-card img {
        width: 180px;
        height: 180px;
        object-fit: cover;
        border-radius: 12px; /* <— FOTO NORMAL (BUKAN BULAT) */
        box-shadow: none !important; /* Hilangkan efek */
        border: none !important;
    }

    .team-card h4 {
        margin-top: 15px;
        font-size: 20px;
        font-weight: 700;
    }

    .team-card p {
        opacity: .75;
        font-size: 15px;
        margin-top: 3px;
    }

    .divider {
        height: 1px;
        background: rgba(255,255,255,0.10);
        width: 100%;
        margin: 50px auto;
    }

    /* SCROLL FIX */
    html, body {
        height: auto !important;
        overflow-y: auto !important;
    }

    .page-wrapper {
        min-height: 100vh !important;
        display: flex;
        flex-direction: column;
        overflow-y: visible !important;
    }
</style>



<div class="about-hero">
    <h1>Building the Future of</h1>
    <h2>Professional Services</h2>
    <p>
        Menghadirkan layanan jasa terbaik untuk kebutuhan Anda — dari rumah hingga bisnis.
        Jasain.Aja selalu hadir memberikan solusi profesional dan terpercaya.
    </p>
</div>



<div class="section-block">
    <h2>Misi & Visi Kami</h2>
    <p class="section-desc">Prinsip yang memandu kami untuk masa depan.</p>

    <div class="mission-vision">

        <div>
            <h3>Misi</h3>
            <p>
                <p>🌐 Mempermudah masyarakat dalam menemukan, membandingkan, dan memesan berbagai jenis jasa melalui sistem yang praktis, aman, dan transparan.
                <p>💼 Mendukung penyedia jasa, mulai dari individu, freelancer, hingga pelaku UMKM, dengan alat digital untuk mempromosikan layanan, menampilkan portofolio, dan mengelola pesanan.
                <p>🤝 Menciptakan ekosistem transaksi jasa yang saling menguntungkan melalui fitur ulasan, rating, dan komunikasi yang jelas antara penyedia jasa dan pelanggan.
                <p>🚀 Mendorong pertumbuhan ekonomi digital dengan membantu pelaku jasa beradaptasi dan berkembang di era teknologi.
            </p>
        </div>

        <div>
            <h3>Visi</h3>
            <p>
                Menjadi platform promosi dan jual beli jasa terpercaya di Indonesia yang tidak hanya
                mempermudah proses pencarian dan pemesanan jasa, tetapi juga membangun budaya profesional,
                aman, dan bertanggung jawab dalam setiap layanan yang diberikan.
            </p>
        </div>

    </div>
</div>


<div class="divider"></div>



<div class="section-block">
    <h2>Cerita Kami</h2>

    <p class="story-text">
        Jasain Aja berawal dari misi sederhana: membantu masyarakat mendapatkan layanan jasa profesional dengan mudah.
        Dari tim kecil, kini kami melayani ribuan pelanggan setiap bulan di seluruh Indonesia.
    </p>
</div>


<div class="divider"></div>



<div class="section-block">
    <h2>Tim Kami</h2>
    <p class="section-desc">Orang-orang hebat di balik Jasain Aja</p>

    <div class="team-wrapper">

        <div class="team-card">
             <img src="<?php echo e(asset('images/foto1.png')); ?>" alt="">
            <h4>Mohammad Hafidz Suhaiby</h4>
            <p></p>
        </div>

        <div class="team-card">
             <img src="<?php echo e(asset('images/foto2.png')); ?>" alt="">
            <h4>Jidan Syaputra Laut</h4>
        </div>

        <div class="team-card">
            <img src="<?php echo e(asset('images/foto3.jpg')); ?>" alt="">
            <h4>Muhammad Naufal Zhafran</h4>
        </div>

    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\tubes_pemweb\JASAIN.AJA\resources\views/tentang.blade.php ENDPATH**/ ?>