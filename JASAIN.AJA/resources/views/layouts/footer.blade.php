{{-- resources/views/layouts/footer.blade.php --}}

<style>
  .footer-custom {
    background-color: #061537; /* warna footer lebih gelap */
    padding-top: 40px;
    padding-bottom: 25px;
}

/* Link footer */
.footer-links li a {
    color: #b8c6de;
    text-decoration: none;
    display: block;
    margin-bottom: 6px;
    transition: .2s;
}

.footer-links li a:hover {
    color: #ffffff;
    padding-left: 4px;
}

/* Sosial media icon */
.social {
    color: #b8c6de;
    transition: .2s;
}

.social:hover {
    color: #4e8bff;
}

    }
</style>
<footer class="footer-custom text-white pt-5 pb-4">

    <div class="container">

        <div class="row">

            {{-- MENU --}}
            <div class="col-12 col-md-3 mb-4">
                <h5 class="fw-bold mb-3">Menu</h5>
                <ul class="list-unstyled footer-links">
                    <li><a href="/home">Home</a></li>
                    <li><a href="/tentang">Tentang Kami</a></li>
                    <li><a href="/jasa">Jasa</a></li>
                    <li><a href="/daftar-jasa">Daftar Jasa</a></li>
                </ul>
            </div>

            {{-- IKUTI KAMI --}}
            <div class="col-12 col-md-3 mb-4">
                <h5 class="fw-bold mb-3">Ikuti Kami</h5>

                <div class="d-flex gap-3 fs-4">
                    <a href="#" class="social"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="social"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social"><i class="fab fa-x-twitter"></i></a>
                    <a href="#" class="social"><i class="fab fa-youtube"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>

        </div>

        <hr class="mt-4 opacity-25">

        <p class="text-center mt-3 mb-0">
            © 2025 JASAIN.AJA — All Rights Reserved.
        </p>

    </div>

</footer>

{{-- FontAwesome untuk ikon --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js"></script>
