// resources/js/admin.js

import './bootstrap';

import $ from 'jquery';
import Swal from 'sweetalert2';
import DataTable from 'datatables.net-dt';

window.$ = window.jQuery = $;
window.Swal = Swal;

$(function () {

    // ==========================================
    // 1. DATATABLES (khusus halaman admin)
    // ==========================================

    // tabel kecil di dashboard (tanpa paging)
    if ($('.dashboard-data-tables').length) {
        new DataTable('.dashboard-data-tables', {
            responsive: true,
            info: false,
            lengthChange: false,
            layout: {
                topStart: 'search',
                topEnd: null
            },
            paging: false,
        });
    }

    // Data Pengguna
    if ($('#user-data-tables').length) {
        new DataTable('#user-data-tables', {
            responsive: true,
        });
    }

    // Data Jasa
    if ($('#service-data-tables').length) {
        new DataTable('#service-data-tables', {
            responsive: true,
        });
    }

    // Data Pesanan
    if ($('#order-data-tables').length) {
        new DataTable('#order-data-tables', {
            responsive: true,
        });
    }

    // Data Laporan
    if ($('#report-data-tables').length) {
        new DataTable('#report-data-tables', {
            responsive: true,
        });
    }


    // ==========================================
    // 2. DROPDOWN NAVBAR & ACTION MENU
    // ==========================================

    // dropdown menu kiri (Dashboard, Data Pengguna, dst.)
    const $toggleBtn     = $('#dropdown-toggle');
    const $dropdownMenu  = $('#dropdown-menu');
    const $dropdownIcon  = $('#dropdown-icon');

    $toggleBtn.on('click', function (e) {
        e.stopPropagation();
        $dropdownMenu.toggleClass('hidden');
        $dropdownIcon.toggleClass('rotate-180');
    });

    // profile dropdown (My Profile, Logout)
    const $profileToggle = $('#profile-toggle');
    const $profileMenu   = $('#profile-menu');
    const $profileIcon   = $('#profile-icon');

    $profileToggle.on('click', function (e) {
        e.stopPropagation();
        $profileMenu.toggleClass('hidden');
        $profileIcon.toggleClass('rotate-180');
    });

    // dropdown “aksi” per baris tabel (kalau nanti dipakai)
    const $actionToggle  = $('.action-dropdown-toggle');
    const $actionMenu    = $('.action-dropdown-menu');

    $actionToggle.on('click', function (e) {
        e.stopPropagation();
        const $menu = $(this).next($actionMenu);
        $actionMenu.not($menu).addClass('hidden');
        $menu.toggleClass('hidden');
    });

    // tutup semua dropdown saat klik di luar
    $(document).on('click', function () {
        $dropdownMenu.addClass('hidden');
        $dropdownIcon.removeClass('rotate-180');

        $profileMenu.addClass('hidden');
        $profileIcon.removeClass('rotate-180');

        $actionMenu.addClass('hidden');
    });

    // biar klik di dalam menu nggak nutup dropdown
    $profileMenu.on('click',  e => e.stopPropagation());
    $dropdownMenu.on('click', e => e.stopPropagation());
    $actionMenu.on('click',   e => e.stopPropagation());


    // ==========================================
    // 3. SWEETALERT TOAST (sukses / error)
    // ==========================================

    const successMessage = $('body').data('success-message');
    const errorMessage   = $('body').data('error-message');

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: toast => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });

    if (successMessage) {
        Toast.fire({
            icon: 'success',
            title: successMessage
        });
    }

    if (errorMessage) {
        Toast.fire({
            icon: 'error',
            title: errorMessage
        });
    }
});
