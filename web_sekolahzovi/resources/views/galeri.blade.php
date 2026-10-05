@php
    // Foto galeri diambil dari database (yang kamu tambah/edit di dashboard admin).
    // Yang terbaru tampil paling depan.
    $galeris = \App\Models\Galeri::orderByDesc('tanggal')->orderByDesc('id')->get();
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Galeri Sekolah - SMKN 4 Bogor</title>
@vite(['resources/css/app.css', 'resources/css/pages/galeri.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-slate-700">

  {{-- ====================== NAVBAR ====================== --}}
  <header class="navbar-dark sticky top-0 z-50 shadow-md">
    <div class="max-w-6xl mx-auto px-5 py-3 flex items-center justify-between">
      <div class="flex items-center gap-2.5">
        <img src="{{ asset('images/logo.png') }}" class="w-10 h-10 object-contain" alt="Logo SMK Negeri 4 Kota Bogor">
        <span class="text-white font-bold tracking-wide text-sm md:text-base">SMKN 4 BOGOR</span>
      </div>
      <nav class="hidden md:flex items-center gap-6">
        <a href="{{ url('/') }}" class="nav-link">Home</a>
        <a href="{{ url('/profil') }}" class="nav-link">Profil</a>
        <a href="{{ url('/artikel') }}" class="nav-link">Artikel</a>
        <a href="{{ url('/galeri') }}" class="nav-link active">Galeri</a>
        <a href="{{ url('/ekstrakulikuler') }}" class="nav-link">Ekstrakulikuler</a>
        <a href="{{ url('/produk') }}" class="nav-link">Produk</a>
        <a href="{{ url('/kontak') }}" class="nav-link">Kontak</a>
      </nav>
      <div class="flex items-center gap-3">
        <a href="{{ url('/login') }}" class="login-btn hidden md:inline-block">Login Admin</a>
        <button class="md:hidden text-white">
          <img src="https://api.iconify.design/mdi/menu.svg?color=%23ffffff" class="w-7 h-7" alt="Menu">
        </button>
      </div>
    </div>
  </header>

  {{-- ====================== BANNER GRADASI BIRU ====================== --}}
  <section class="galeri-hero">
    <div class="max-w-6xl mx-auto px-5 py-10 md:py-14">
      <h1 class="text-white text-2xl md:text-3xl font-extrabold">Galeri</h1>
      <p class="text-white/90 font-semibold text-sm md:text-base -mt-1">SMKN 4 BOGOR</p>
      <p class="text-blue-100 text-xs md:text-sm mt-3 max-w-2xl leading-relaxed">
        Galeri foto berisi berbagai momen dan kegiatan sekolah, mulai dari upacara, kegiatan
        keagamaan, seremoni resmi, hingga prestasi siswa SMKN 4 Bogor.
      </p>
    </div>
  </section>

  {{-- ====================== GALERI FOTO (MASONRY) ====================== --}}
  <div class="max-w-6xl mx-auto px-5 py-10">
    <div class="masonry">
      @foreach ($galeris as $g)
        @if ($g->foto_url)
          <img src="{{ $g->foto_url }}" alt="{{ $g->judul }}" data-nama="{{ $g->judul }}">
        @endif
      @endforeach
    </div>

    @if ($galeris->isEmpty())
      <p class="text-sm text-slate-400 text-center py-10">Belum ada foto galeri.</p>
    @endif
  </div>

  {{-- ====================== LIGHTBOX / POPUP FOTO ====================== --}}
  <div id="lightbox" class="lightbox hidden">
    <button id="lightbox-close" class="lightbox-close" aria-label="Tutup">&times;</button>
    <div class="lightbox-content">
      <img id="lightbox-img" src="" alt="">
      <p id="lightbox-nama"></p>
    </div>
  </div>

  {{-- ====================== FOOTER FOTO ====================== --}}
  <section class="relative overflow-hidden h-40 md:h-56">
    <img src="{{ asset('images/lapangan 7.JPG') }}" class="w-full h-full object-cover" alt="Lapangan SMKN 4 Bogor">
  </section>
  <div class="navy text-center text-[11px] tracking-wide text-slate-300 py-3">
    &copy; {{ date('Y') }} SMKN 4 KOTA BOGOR • EDUMANAGE V4.2.0
  </div>

  <script>
    document.querySelectorAll('.nav-link').forEach(function (link) {
      link.addEventListener('click', function () {
        document.querySelectorAll('.nav-link').forEach(function (l) {
          l.classList.remove('active');
        });
        link.classList.add('active');
      });
    });

    var lightbox = document.getElementById('lightbox');
    var lightboxImg = document.getElementById('lightbox-img');
    var lightboxNama = document.getElementById('lightbox-nama');

    document.querySelectorAll('.masonry img').forEach(function (foto) {
      foto.addEventListener('click', function () {
        lightboxImg.src = foto.src;
        lightboxNama.textContent = foto.getAttribute('data-nama');
        lightbox.classList.remove('hidden');
      });
    });

    function tutupLightbox() {
      lightbox.classList.add('hidden');
      lightboxImg.src = '';
    }
    document.getElementById('lightbox-close').addEventListener('click', tutupLightbox);
    lightbox.addEventListener('click', function (e) {
      if (e.target === lightbox) tutupLightbox();
    });
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') tutupLightbox();
    });
  </script>
</body>
</html>