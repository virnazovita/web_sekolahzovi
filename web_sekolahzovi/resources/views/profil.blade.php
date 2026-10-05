<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Profil Sekolah - SMKN 4 Bogor</title>
@vite(['resources/css/app.css', 'resources/css/pages/profil.css', 'resources/js/app.js'])
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
        <a href="{{ url('/profil') }}" class="nav-link active">Profil</a>
        <a href="{{ url('/artikel') }}" class="nav-link">Artikel</a>
        <a href="{{ url('/galeri') }}" class="nav-link">Galeri</a>
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

  {{-- ====================== BANNER KECIL ====================== --}}
  <section class="relative overflow-hidden h-48 md:h-64">
    <img src="{{ asset('images/upacara 1.JPG') }}" class="w-full h-full object-cover" alt="Upacara bendera SMKN 4 Bogor">
    <div class="absolute inset-0 bg-black/40"></div>
    <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-5">
      <h1 class="text-white text-2xl md:text-3xl font-bold drop-shadow">Profil Sekolah</h1>
      <p class="text-slate-200 text-xs md:text-sm mt-2">Home &gt; Profil</p>
    </div>
  </section>

  <div class="max-w-5xl mx-auto px-5">
    <p class="flex items-center gap-2 text-xs tracking-[0.2em] text-slate-400 mt-6 mb-10">
      <span class="w-8 h-px bg-slate-300 inline-block"></span> S M K N 4 B O G O R
    </p>

    {{-- ====================== SEJARAH SEKOLAH ====================== --}}
    <h2 class="text-lg md:text-xl font-bold navy-text mb-4">Sejarah Sekolah</h2>
    <div class="grid md:grid-cols-3 gap-6 items-start mb-16">
      <div class="md:col-span-2 navy text-white rounded-xl p-5 text-sm leading-relaxed">
        <p>
          SMKN 4 Bogor berdiri pada 15 Juni 2009 sebagai sekolah kejuruan negeri di Kota
          Bogor. Sejak awal berdirinya, sekolah ini berkomitmen mencetak lulusan yang
          kompeten, berkarakter, dan siap menghadapi dunia kerja maupun pendidikan tinggi
          melalui pendidikan vokasi yang berkualitas.
        </p>
        <p class="mt-3">
          SMKN 4 Bogor merupakan Sekolah Menengah Kejuruan negeri yang berada di Kota Bogor,
          Jawa Barat. Sekolah ini resmi didirikan berdasarkan Surat Keputusan Nomor
          421-45-177 Tahun 2009 pada 15 Juni 2009. Sejak berdiri, SMKN 4 Bogor berkomitmen
          menghasilkan lulusan yang kompeten, berkarakter, dan siap bersaing di dunia kerja
          maupun melanjutkan pendidikan. Hingga saat ini, SMKN 4 Bogor terus berkembang
          dengan berbagai program keahlian, fasilitas yang memadai, serta kerja sama dengan
          dunia usaha dan dunia industri untuk mendukung pendidikan vokasi yang berkualitas.
        </p>
      </div>
      <img src="{{ asset('images/lapangan 6.JPG') }}" class="rounded-xl shadow-lg w-full aspect-[4/3] object-cover" alt="Pemandangan SMKN 4 Bogor">
    </div>

    {{-- ====================== SAMBUTAN KEPALA SEKOLAH ====================== --}}
    <h2 class="text-lg md:text-xl font-bold navy-text mb-4">Sambutan Kepala Sekolah SMKN 4</h2>
    <div class="grid md:grid-cols-3 gap-6 items-start mb-16">
      <img src="{{ asset('images/kepala sekolah.jpg') }}" class="rounded-xl shadow w-48 md:w-56 object-cover" style="aspect-ratio:4/5" alt="Foto Kepala Sekolah SMKN 4 Bogor">
      <div class="md:col-span-2 border border-slate-200 rounded-xl p-5 text-sm text-slate-600 leading-relaxed shadow-sm">
        <p>
          Drs. Mulya Murprihartono, M.Si. merupakan Kepala SMKN 4 Bogor yang memiliki
          komitmen tinggi dalam meningkatkan mutu pendidikan vokasi. Di bawah
          kepemimpinannya, sekolah terus memperkuat kerja sama dengan dunia usaha dan dunia
          industri, mengembangkan pembelajaran berbasis kompetensi, serta mendorong peserta
          didik menjadi lulusan yang berkarakter, kompeten, dan siap menghadapi dunia kerja
          maupun pendidikan tinggi.
        </p>
        <p class="mt-4 font-bold navy-text">Drs. Mulya Murprihartono, M.Si.</p>
        <p class="text-xs text-slate-400">KEPALA SEKOLAH SMKN 4 BOGOR</p>
      </div>
    </div>

    {{-- ====================== VISI, MISI, MOTO & SLOGAN ====================== --}}
    <div class="grid md:grid-cols-3 gap-4 mb-16 items-start">
      <div class="border border-slate-200 rounded-xl p-5 shadow-sm">
        <h3 class="font-bold navy-text mb-2">Visi:</h3>
        <p class="text-sm text-slate-600 leading-relaxed">
          Menjadi Sekolah Menengah Kejuruan yang unggul dalam menghasilkan lulusan yang
          beriman dan bertakwa kepada Tuhan Yang Maha Esa, berkarakter, kompeten, inovatif,
          berwawasan lingkungan, serta mampu bersaing di dunia usaha, dunia industri, dan
          pendidikan tinggi pada tingkat nasional maupun global.
        </p>
      </div>
      <div class="navy text-white rounded-xl p-5 shadow-sm">
        <h3 class="font-bold mb-2">Misi:</h3>
        <ol class="text-sm leading-relaxed list-decimal list-inside space-y-1">
          <li>Menyelenggarakan pendidikan yang berkualitas dan sesuai perkembangan teknologi.</li>
          <li>Membentuk peserta didik yang berakhlak, disiplin, dan bertanggung jawab.</li>
          <li>Mengembangkan kompetensi sesuai kebutuhan dunia kerja.</li>
          <li>Menumbuhkan kreativitas, inovasi, dan jiwa kewirausahaan.</li>
          <li>Menciptakan lingkungan belajar yang aman dan nyaman.</li>
          <li>Membangun kerja sama dengan dunia usaha dan dunia industri.</li>
        </ol>
      </div>
      <div class="flex flex-col gap-4">
        <div class="border border-slate-200 rounded-xl p-5 shadow-sm">
          <h3 class="font-bold navy-text mb-2">Moto:</h3>
          <p class="text-sm text-slate-600 leading-relaxed italic">
            "Berkarakter, Kompeten, Siap Berkarya."
          </p>
        </div>
        <div class="navy text-white rounded-xl p-5 shadow-sm">
          <h3 class="font-bold mb-2">Slogan:</h3>
          <p class="text-sm leading-relaxed">
            SMKN 4 Bogor, Siap Kerja, Siap Kuliah, Siap Wirausaha.
          </p>
        </div>
      </div>
    </div>

    {{-- ====================== STRUKTUR ORGANISASI ====================== --}}
    <h2 class="text-lg md:text-xl font-bold navy-text text-center mb-8">Struktur Organisasi</h2>

    <div class="flex flex-col items-center mb-6">
      <div class="org-box active w-64">
        <p class="font-bold text-sm">Kepala Sekolah</p>
        <p class="text-xs mt-0.5">Drs. Mulya Murprihartono, M.Si.</p>
      </div>
      <div class="w-px h-8 bg-slate-300"></div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-16 max-w-3xl mx-auto">
      <div class="org-box">
        <p class="font-bold text-sm">Wakil Kurikulum</p>
        <p class="text-xs text-slate-500 mt-0.5">Ibu. Novita Wandasari</p>
      </div>
      <div class="org-box active">
        <p class="font-bold text-sm">Wakil Kesiswaan</p>
        <p class="text-xs mt-0.5">Bpk. Mulyadi</p>
      </div>
      <div class="org-box">
        <p class="font-bold text-sm">Wakil Sarpras</p>
        <p class="text-xs text-slate-500 mt-0.5">Bpk. Wahyu Wibowo</p>
      </div>
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
  </script>
</body>
</html>