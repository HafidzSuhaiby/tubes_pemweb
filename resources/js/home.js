document.addEventListener('DOMContentLoaded', () => {
    const cariJasa   = document.getElementById('btnCariJasa');
    const daftarJasa = document.getElementById('btnDaftarJasa');

    if (cariJasa && daftarJasa) {

        // set default: Cari Jasa aktif
        cariJasa.classList.add('btn-main-active');
        daftarJasa.classList.add('btn-main-inactive');

        const setActive = (activeBtn, inactiveBtn) => {
            activeBtn.classList.add('btn-main-active');
            activeBtn.classList.remove('btn-main-inactive');

            inactiveBtn.classList.add('btn-main-inactive');
            inactiveBtn.classList.remove('btn-main-active');
        };

        // mirip logic lihatHewan & pelajari
        cariJasa.addEventListener('mouseenter', () => {
            setActive(cariJasa, daftarJasa);
        });

        daftarJasa.addEventListener('mouseenter', () => {
            setActive(daftarJasa, cariJasa);
        });

        // optional: klik juga ganti state permanen
        cariJasa.addEventListener('click', (e) => {
            setActive(cariJasa, daftarJasa);
        });

        daftarJasa.addEventListener('click', (e) => {
            setActive(daftarJasa, cariJasa);
        });
    }
});
