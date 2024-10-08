<div class="navbar-container">
    <div class="navbar-logo">
        <a href="/"><img  src="svg/logo.svg" alt="as"></img></a>
    </div>
    <div class="navbar-mobile">
        <div class="main-notifikasi">
            {{-- <div class="notifikasi"></div> --}}
        </div>
        <div class="navbar-toggle">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="navbar-main">
        <div class="navbar-main-1">
            <div><x-nav-link href="/" :active="request()->is('/')">Beranda</x-nav-link></div>
            <div class="pelayanan">
            <x-nav-link :active="request()->is('laporan') || request()->is('#')">Pelayanan</x-nav-link>
            <span><img src="svg/dropdown-pelayanan.svg" alt=""></span>
            <ul class="dropdown-menu">
                <li><a href="/laporan">Pencarian Barang Hilang</a></li>
                <li><a href="#">Pencarian Orang Hilang</a></li>
            </ul>
        </div>

            <div><x-nav-link href="/contact" :active="request()->is('contact')">Hubungi Kami</x-nav-link></div>
        </div>
        <div class="navbar-container-2">
            <div class="navbar-main-2">
                <div>Husain</div>
                <div class="border-image">
                    <img src="img/profile.png" alt="tes">
                </div>
            </div>
            <div class="main-notifikasi">
                {{-- <div class="notifikasi"></div> --}}
            </div>
        </div>
    </div>
</div>
