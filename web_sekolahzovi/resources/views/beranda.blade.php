<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SMKN 4 Bogor</title>
@vite(['resources/css/app.css', 'resources/css/pages/home.css', 'resources/js/app.js'])
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
        <a href="{{ url('/') }}" class="nav-link active">Home</a>
        <a href="{{ url('/profil') }}" class="nav-link">Profil</a>
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

  {{-- ====================== HERO ====================== --}}
  <section id="beranda" class="relative overflow-hidden">
    <img src="{{ asset('images/lapangan 1.JPG') }}" class="w-full h-[420px] object-cover" alt="Lapangan SMKN 4 Bogor tampak udara">
    <div class="absolute inset-0" style="background:linear-gradient(90deg, rgba(6,20,46,.65) 0%, rgba(6,20,46,.15) 45%, rgba(6,20,46,0) 65%);"></div>

    {{-- collage 2 foto miring kanan atas --}}
    <div class="hidden md:block absolute top-10 right-12 w-72 h-40">
      <img src="{{ asset('images/lapangan 2.JPG') }}" class="rounded-xl shadow-2xl border-4 border-white w-52 h-36 object-cover absolute -rotate-6 top-0 right-10" alt="Lapangan SMKN 4 Bogor tampak 2">
      <img src="{{ asset('images/lapangan 3.JPG') }}" class="rounded-xl shadow-2xl border-4 border-white w-52 h-36 object-cover absolute rotate-3 top-14 right-0" alt="Lapangan SMKN 4 Bogor tampak 3">
    </div>

    <div class="absolute inset-0 flex items-end md:items-center pb-8 md:pb-0">
      <div class="max-w-6xl mx-auto w-full px-5">
        <div class="text-white max-w-md">
          <h1 class="text-2xl md:text-4xl font-extrabold leading-tight drop-shadow">SMKN 4 BOGOR</h1>
          <p class="mt-3 text-xs md:text-sm text-slate-100 leading-relaxed drop-shadow">
            Tenaga pendidik yang profesional, fasilitas pembelajaran yang memadai, serta kerja
            sama dengan dunia usaha dan dunia industri, SMKN 4 Bogor membekali peserta didik
            agar siap bekerja, melanjutkan pendidikan maupun berwirausaha. Motto sekolah adalah
            menciptakan generasi yang siap kerja, santun, mandiri, dan kreatif.
          </p>
        </div>
      </div>
    </div>
  </section>

  {{-- ====================== STATISTIK ====================== --}}
  <section class="max-w-5xl mx-auto px-5 -mt-10 relative z-10">
    <div class="bg-white rounded-2xl shadow-lg grid grid-cols-2 md:grid-cols-4 gap-4 p-5">
      @php
        $statistik = [
          ['icon' => 'mdi/account-group', 'color' => '#2563eb', 'bg' => 'bg-blue-100', 'angka' => '1.687', 'label' => 'Total siswa'],
          ['icon' => 'mdi/account-tie', 'color' => '#059669', 'bg' => 'bg-emerald-100', 'angka' => '99', 'label' => 'Total guru'],
          ['icon' => 'mdi/home-city', 'color' => '#ea580c', 'bg' => 'bg-orange-100', 'angka' => '48', 'label' => 'Jumlah kelas'],
          ['icon' => 'mdi/notebook-edit-outline', 'color' => '#7c3aed', 'bg' => 'bg-purple-100', 'angka' => '18', 'label' => 'Jumlah mapel'],
        ];
      @endphp
      @foreach($statistik as $s)
        <div class="flex items-center gap-3">
          <span class="w-12 h-12 rounded-full {{ $s['bg'] }} flex items-center justify-center shrink-0">
            <img src="https://api.iconify.design/{{ $s['icon'] }}.svg?color=%23{{ ltrim($s['color'],'#') }}" class="w-6 h-6" alt="{{ $s['label'] }}">
          </span>
          <div>
            <p class="text-lg font-bold navy-text leading-none">{{ $s['angka'] }}</p>
            <p class="text-xs text-slate-500 mt-1">{{ $s['label'] }}</p>
          </div>
        </div>
      @endforeach
    </div>
  </section>

  {{-- ====================== PROGRAM KEAHLIAN ====================== --}}
  <section id="program" class="max-w-6xl mx-auto px-5 mt-16">
    <h2 class="text-xl md:text-2xl font-bold navy-text">Program Keahlian (Jurusan)</h2>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6">
      @php
        $jurusan = [
          ['img' => asset('images/jurusan PPLG.jpg'), 'badge' => asset('images/logo pplg.jpg'), 'nama' => 'Pengembangan Perangkat Lunak dan Gim'],
          ['img' => asset('images/jurusan TO.jpg'), 'badge' => asset('images/logo otomotif.jpg'), 'nama' => 'Teknik Otomotif'],
          ['img' => asset('images/jurusan TJKT.jpg'), 'badge' => asset('images/logo tjkt.jpg'), 'nama' => 'Teknik Komputer dan Jaringan'],
          ['img' => asset('images/jurusan TPFL.jpg'), 'badge' => asset('images/logo tpfl.jpg'), 'nama' => 'Teknik Pengelasan dan Fabrikasi Logam'],
        ];
      @endphp
      @foreach($jurusan as $j)
        <div class="rounded-xl overflow-hidden shadow hover:shadow-lg transition-shadow bg-white">
          <img src="{{ $j['img'] }}" class="w-full object-cover" style="aspect-ratio:1/1" alt="{{ $j['nama'] }}">
          <div class="p-3 flex items-center gap-2">
            <img src="{{ $j['badge'] }}" class="w-7 h-7 rounded-full object-contain shrink-0" alt="Logo {{ $j['nama'] }}">
            <p class="text-xs md:text-sm font-semibold navy-text leading-snug">{{ $j['nama'] }}</p>
          </div>
        </div>
      @endforeach
    </div>
  </section>

  {{-- ====================== BERITA TERKINI ====================== --}}
  <section id="berita" class="max-w-6xl mx-auto px-5 mt-16">
    <h2 class="text-xl md:text-2xl font-bold navy-text">Berita Terkini</h2>
    <p class="text-xs text-slate-400 mt-1 mb-6">Beranda > Berita</p>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
      @php
        $berita = [
          [
            'img' => asset('images/juara 1 LKS TJKT.jpg'),
            'judul' => 'Juara 1 LKS Tingkat Kota Bidang Keahlian NETWORK CABLING',
          ],
          [
            'img' => asset('images/juara 3 IBG CHAMPIONSHIP.jpg'),
            'judul' => 'Juara 3 Tingkat SMA/SMK/MA Sederajat IBG CHAMPIONSHIP FESTIVAL 2026',
          ],
          [
            'img' => asset('images/juara 1 IOFEST.jpg'),
            'judul' => 'Juara 1 IOFEST Bidang UI/UX di Universitas Tarumanagara',
          ],
          [
            'img' => asset('images/juara 3 LKS WEB TECHNOLOGY.jpg'),
            'judul' => 'Juara 3 LKS Tingkat Kota Bidang Keahlian WEB TECHNOLOGY',
          ],
        ];
      @endphp
      @foreach($berita as $b)
        <article class="rounded-xl overflow-hidden shadow hover:shadow-lg transition-shadow bg-white">
          <img src="{{ $b['img'] }}" class="w-full object-cover" style="aspect-ratio:4/5" alt="{{ $b['judul'] }}">
          <div class="p-3">
            <p class="text-xs font-semibold navy-text leading-snug">{{ $b['judul'] }}</p>
          </div>
        </article>
      @endforeach
    </div>
  </section>

  {{-- ====================== TENTANG SEKOLAH ====================== --}}
  <section id="tentang" class="max-w-6xl mx-auto px-5 mt-16 grid md:grid-cols-2 gap-10 items-center">
    <div class="relative pb-10 pr-10 md:pb-14 md:pr-14">
      <img src="{{ asset('images/view sekolah.jpg') }}" class="rounded-2xl shadow-lg w-full aspect-video object-cover" alt="Pemandangan udara SMKN 4 Bogor">
      <img src="{{ asset('images/lapangan 4.JPG') }}" class="rounded-2xl shadow-lg border-4 border-white object-cover absolute bottom-0 right-0 w-2/3 aspect-[4/3]" alt="Lapangan SMKN 4 Bogor">
    </div>
    <div>
      <h2 class="text-xl md:text-2xl font-bold navy-text">Tentang Sekolah</h2>
      <p class="text-sm text-slate-600 mt-3 leading-relaxed">
        SMKN 4 Bogor adalah sekolah menengah kejuruan yang berkomitmen mencetak lulusan
        kompeten, berkarakter, dan siap kerja. Didukung fasilitas praktik yang memadai serta
        tenaga pengajar berpengalaman, sekolah ini terus berupaya menyelaraskan kurikulum
        dengan kebutuhan dunia industri dan dunia usaha.
      </p>
      <p class="text-sm text-slate-600 mt-3 leading-relaxed">
        Berbagai program keahlian tersedia untuk mengasah minat dan bakat siswa, dilengkapi
        dengan kegiatan ekstrakurikuler serta kerja sama industri untuk pengalaman kerja
        nyata melalui program magang.
      </p>
    </div>
  </section>

  {{-- ====================== FOOTER / HUBUNGI KAMI ====================== --}}
  <footer id="kontak" class="navy text-white mt-16">
    <div class="max-w-6xl mx-auto px-5 py-10 grid md:grid-cols-3 gap-8">
      <div>
        <h3 class="font-bold mb-3">Hubungi Kami</h3>
        <div class="flex items-start gap-2 text-sm text-slate-200 mb-2">
          <img src="https://api.iconify.design/mdi/map-marker.svg?color=%23ffffff" class="w-5 h-5 mt-0.5" alt="Alamat">
          <span>Jl. Contoh Raya No. 4, Kota Bogor, Jawa Barat</span>
        </div>
        <div class="flex items-center gap-2 text-sm text-slate-200 mb-2">
          <img src="https://api.iconify.design/mdi/phone.svg?color=%23ffffff" class="w-5 h-5" alt="Telepon">
          <span>(0251) 123-4567</span>
        </div>
        <div class="flex items-center gap-2 text-sm text-slate-200">
          <img src="https://api.iconify.design/mdi/email.svg?color=%23ffffff" class="w-5 h-5" alt="Email">
          <span>info@smkn4bogor.sch.id</span>
        </div>
      </div>

      <div>
        <h3 class="font-bold mb-3">Tautan</h3>
        <ul class="space-y-2 text-sm text-slate-200">
          <li><a href="#program" class="hover:text-sky-300">Program Keahlian</a></li>
          <li><a href="#berita" class="hover:text-sky-300">Berita</a></li>
          <li><a href="#tentang" class="hover:text-sky-300">Tentang Sekolah</a></li>
        </ul>
      </div>

      <div>
        <h3 class="font-bold mb-3">Media Sosial</h3>
        <div class="flex gap-3">
          <img src="https://api.iconify.design/mdi/instagram.svg?color=%23ffffff" class="w-6 h-6" alt="Instagram">
          <img src="https://api.iconify.design/mdi/facebook.svg?color=%23ffffff" class="w-6 h-6" alt="Facebook">
          <img src="https://api.iconify.design/mdi/youtube.svg?color=%23ffffff" class="w-6 h-6" alt="YouTube">
        </div>
      </div>
    </div>
    <div class="border-t border-white/20 text-center text-[11px] tracking-wide text-slate-300 py-4">
      &copy; {{ date('Y') }} SMKN 4 KOTA BOGOR • EDUMANAGE V4.2.0
    </div>
  </footer>

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