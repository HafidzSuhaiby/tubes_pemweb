import Swiper from 'swiper/bundle';
import 'swiper/css/bundle';

// Inisialisasi Swiper hanya kalau elemen ada (biar nggak error di halaman lain)
document.addEventListener('DOMContentLoaded', () => {
    const swiperEl = document.querySelector('.mySwiper');
    if (swiperEl) {
        new Swiper('.mySwiper', {
            loop: true,
            autoplay: { delay: 2500, disableOnInteraction: false },
            slidesPerView: 1,
            pagination: { el: '.swiper-pagination', clickable: true },
            navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
        });
    }
});

// Fungsi filter dipanggil dari HTML (onclick), jadi taruh di window
window.applyFilter = function () {
    const kategori = document.getElementById('filterKategori')?.value || '';
    const lokasi   = document.getElementById('filterArea')?.value || '';

    document.querySelectorAll('.card-item').forEach(card => {
        const cardKategori = card.dataset.kategori || '';
        const cardLokasi   = card.dataset.lokasi || '';

        const cocokKategori = !kategori || cardKategori === kategori;
        const cocokLokasi   = !lokasi   || cardLokasi === lokasi;

        card.style.display = (cocokKategori && cocokLokasi) ? '' : 'none';
    });
};
