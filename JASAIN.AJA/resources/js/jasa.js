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

document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('.btn-booking');

    const serviceIdInput = document.getElementById('bookingServiceId');
    const jasaNamaEl     = document.getElementById('modalJasaNama');
    const jasaKategoriEl = document.getElementById('modalJasaKategori');
    const jasaLokasiEl   = document.getElementById('modalJasaLokasi');
    const jasaJamEl      = document.getElementById('modalJasaJam');
    const jasaHargaEl    = document.getElementById('modalJasaHarga');
    const jasaFotoEl     = document.getElementById('modalJasaFoto');

    buttons.forEach(btn => {
        btn.addEventListener('click', () => {
            const id       = btn.dataset.id;
            const nama     = btn.dataset.nama;
            const kategori = btn.dataset.kategori;
            const lokasi   = btn.dataset.lokasi;
            const jam      = btn.dataset.jam;
            const harga    = btn.dataset.harga;
            const foto     = btn.dataset.foto;

            // isi hidden input service_id
            serviceIdInput.value = id;

            // isi info jasa di modal
            if (jasaNamaEl)     jasaNamaEl.textContent = nama || '';
            if (jasaKategoriEl) jasaKategoriEl.textContent = kategori || '-';
            if (jasaLokasiEl)   jasaLokasiEl.textContent = lokasi || '-';
            if (jasaJamEl)      jasaJamEl.textContent = jam || '-';

            if (jasaHargaEl) {
                if (harga) {
                    jasaHargaEl.textContent = 'Rp ' + Number(harga).toLocaleString('id-ID');
                } else {
                    jasaHargaEl.textContent = '-';
                }
            }

            if (jasaFotoEl && foto) {
                jasaFotoEl.src = foto;
            }
        });
    });
});