@extends('layouts.main')
@section('title', 'Booking Service')

@section('content')

{{-- Tailwind (CDN) --}}
<script src="https://cdn.tailwindcss.com"></script>

<style>
    body {
        background: #0f1b33 !important;
        font-family: "Poppins", sans-serif;
        color: white;
    }

    .card-bg {
        background: #112344;
    }

    .accent {
        color: #4e8bff;
    }
</style>

<div class="w-full max-w-[1500px] mx-auto mt-10 mb-20 px-6">

    {{-- ============================ HEADER ============================== --}}
    <h1 class="text-center text-3xl font-bold mb-8">Service Booking</h1>

    {{-- ============================ TOP CARD ============================== --}}
    <div class="w-full grid grid-cols-2 gap-6 bg-[#0b1e4a] shadow-xl rounded-xl overflow-hidden">

        {{-- LEFT IMAGE --}}
        <div class="h-[350px] bg-cover bg-center" style="
            background-image: url('{{ asset('images/banner2.png') }}');
        "></div>

        {{-- RIGHT INFO --}}
        <div class="p-10 flex flex-col justify-center">
            <p class="text-gray-300 text-sm">Rp 250.000</p>

            <h2 class="text-2xl font-bold mt-2">Bersih Rumah</h2>

            <p class="text-gray-300 mt-4 leading-relaxed">
                bersihkan seluruh area rumah Anda secara menyeluruh dengan layanan Deep Clean kami yang profesional dan terpercaya.
            </p>

            <p class="text-gray-400 mt-3 text-sm">Est. Duration: 2 hours</p>
        </div>

    </div>

    {{-- ======================== DETAIL PEMESAN =========================== --}}
    <h2 class="mt-14 mb-4 text-xl font-bold">Detail Pemesan</h2>

    <div class="grid grid-cols-1 gap-5">

        <input type="text" placeholder="Full Name"
            class="w-full p-4 rounded-lg card-bg border border-gray-700 focus:border-blue-400 outline-none">

        <input type="text" placeholder="Phone Number / WhatsApp"
            class="w-full p-4 rounded-lg card-bg border border-gray-700 focus:border-blue-400 outline-none">

        <textarea rows="3" placeholder="Full Service Location Address"
            class="w-full p-4 rounded-lg card-bg border border-gray-700 focus:border-blue-400 outline-none"></textarea>

        <input type="email" placeholder="Email (Optional)"
            class="w-full p-4 rounded-lg card-bg border border-gray-700 focus:border-blue-400 outline-none">

        <textarea rows="2" placeholder="Additional Notes (Optional)"
            class="w-full p-4 rounded-lg card-bg border border-gray-700 focus:border-blue-400 outline-none"></textarea>

    </div>

    {{-- ======================== JADWAL =========================== --}}
    <h2 class="mt-14 mb-4 text-xl font-bold">Pilih Jadwal</h2>

    <div class="grid grid-cols-2 gap-6">
        <div>
            <label class="text-sm mb-2 block">Date</label>
            <input type="date"
                class="w-full p-4 rounded-lg card-bg border border-gray-700 focus:border-blue-400 outline-none">
        </div>

        <div>
            <label class="text-sm mb-2 block">Time</label>
            <input type="time"
                class="w-full p-4 rounded-lg card-bg border border-gray-700 focus:border-blue-400 outline-none">
        </div>
    </div>

    {{-- ======================== RINCIAN BIAYA =========================== --}}
    <h2 class="mt-14 mb-4 text-xl font-bold">Rincian Biaya</h2>

    <div class="card-bg rounded-xl p-6 shadow-lg">

        <div class="flex justify-between mb-3">
            <span>Deep Clean Service</span>
            <span>Rp 250.000</span>
        </div>

        <div class="flex justify-between mb-3">
            <span>Additional Costs</span>
            <span>Rp 15.000</span>
        </div>

        <div class="flex justify-between mb-3 text-green-400">
            <span>Voucher Discount</span>
            <span>- Rp 25.000</span>
        </div>

        <hr class="border-gray-600 my-4">

        <div class="flex justify-between text-xl font-bold">
            <span>Total Price</span>
            <span class="accent">Rp 240.000</span>
        </div>
    </div>

    {{-- ======================= METODE PEMBAYARAN ====================== --}}
    <h2 class="mt-14 mb-4 text-xl font-bold">Metode Pembayaran</h2>

<div class="space-y-3" id="payment-options">

    <!-- BCA -->
    <label class="payment-option card-bg p-5 rounded-xl flex justify-between border cursor-pointer"
           data-method="Bank Transfer (BCA)">
        <div class="flex gap-4 items-center">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/4e/Bank_Central_Asia.svg/1200px-Bank_Central_Asia.svg.png"
                 class="h-6">
            <span class="font-semibold">Bank Transfer (BCA)</span>
        </div>

        <div class="radio-indicator w-5 h-5 rounded-full border-2 flex items-center justify-center">
            <div class="dot w-2.5 h-2.5 rounded-full"></div>
        </div>

        <input type="radio" name="payment" value="Bank Transfer (BCA)" class="hidden">
    </label>

    <!-- GOPAY -->
    <label class="payment-option card-bg p-5 rounded-xl flex justify-between border cursor-pointer"
           data-method="E-Wallet (Gopay)">
        <div class="flex gap-4 items-center">
            <img src="https://1000logos.net/wp-content/uploads/2021/05/Gopay-logo.png" class="h-6">
            <span class="font-semibold">E-Wallet (Gopay)</span>
        </div>

        <div class="radio-indicator w-5 h-5 rounded-full border-2 flex items-center justify-center">
            <div class="dot w-2.5 h-2.5 rounded-full"></div>
        </div>

        <input type="radio" name="payment" value="E-Wallet (Gopay)" class="hidden">
    </label>

    <!-- QRIS -->
    <label class="payment-option card-bg p-5 rounded-xl flex justify-between border cursor-pointer"
           data-method="QRIS">
        <div class="flex gap-4 items-center">
            <i class="fa-solid fa-qrcode text-xl"></i>
            <span class="font-semibold">QRIS</span>
        </div>

        <div class="radio-indicator w-5 h-5 rounded-full border-2 flex items-center justify-center">
            <div class="dot w-2.5 h-2.5 rounded-full"></div>
        </div>

        <input type="radio" name="payment" value="QRIS" class="hidden">
    </label>

</div>

    </div>
{{-- ======================= RINGKASAN PESANAN ====================== --}}
<div class="w-full max-w-[1500px] mx-auto px-6">

    <h2 class="mt-14 mb-4 text-xl font-bold text-white">Ringkasan Pesanan</h2>

    <div class="card-bg p-6 rounded-xl shadow-lg text-sm">

        <div class="flex justify-between py-1">
            <span>Service:</span>
            <span class="font-semibold">Deep Clean Service</span>
        </div>

        <div class="flex justify-between py-1">
            <span>Schedule:</span>
            <span class="font-semibold">28 Aug 2024, 09:00 AM</span>
        </div>

        <div class="flex justify-between py-1">
            <span>Location:</span>
            <span class="font-semibold">Jl. Sudirman No. 123, Jakarta</span>
        </div>

        <div class="flex justify-between py-1">
            <span>Payment:</span>
            <span class="font-semibold">Bank Transfer (BCA)</span>
        </div>

        <hr class="border-gray-600 my-4">

        <div class="flex justify-between text-lg font-bold">
            <span>Total Cost:</span>
            <span class="accent">Rp 240.000</span>
        </div>

    </div>

    {{-- ======================= BUTTON ====================== --}}
    <button class="w-full mt-8 py-4 text-lg font-bold rounded-xl
        bg-[#1a1aff] hover:bg-[#5959f7] transition duration-200 shadow-lg">
        Konfirmasi & Bayar
    </button>

</div>


<style>
/* Paksa body & html bisa scroll */
html, body {
    height: auto !important;
    min-height: 100% !important;
    overflow-y: auto !important;
}

/* Override page-wrapper dari layouts.main */
.page-wrapper {
    min-height: auto !important;
    height: auto !important;
    overflow: visible !important;
    display: block !important;
}
</style>

<script>
document.querySelectorAll(".payment-option").forEach(option => {

    option.addEventListener("click", function () {

        // reset semua
        document.querySelectorAll(".payment-option").forEach(o => {
            o.classList.remove("border-blue-500");
            o.querySelector(".radio-indicator").classList.remove("border-blue-400");
            o.querySelector(".dot").classList.remove("bg-blue-400");
        });

        // aktifkan yg dipilih
        this.classList.add("border-blue-500");
        this.querySelector(".radio-indicator").classList.add("border-blue-400");
        this.querySelector(".dot").classList.add("bg-blue-400");

        // update ringkasan
        document.getElementById("summary-payment").innerText = this.dataset.method;

        // centang radio input
        this.querySelector("input").checked = true;
    });
});
</script>

@endsection
