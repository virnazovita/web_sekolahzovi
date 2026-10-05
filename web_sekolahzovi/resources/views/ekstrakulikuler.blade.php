@php
    // Daftar ekstrakurikuler diambil dari database (yang kamu tambah/edit di dashboard admin).
    // Urutannya sama dengan urutan di dashboard. Deskripsi diambil dari kolom "keterangan".
    $daftar = \App\Models\Ekstrakulikuler::orderBy('id')->get()->map(fn ($e) => [
        'nama' => $e->nama,
        'foto' => $e->foto_url,
        'isi'  => $e->keterangan,
    ])->all();

    $menu = [
        ['Home', '/'],
        ['Profil', '/profil'],
        ['Artikel', '/artikel'],
        ['Galeri', '/galeri'],
        ['Ekstrakulikuler', '/ekstrakulikuler'],
        ['Produk', '/produk'],
        ['Kontak', '/kontak'],
    ];
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ekstrakulikuler - SMKN 4 Bogor</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: "Poppins", "Segoe UI", system-ui, sans-serif; color: #111827; background: #fff; }
    a { text-decoration: none; color: inherit; }

    /* ===== Navbar ===== */
    .nav { background: #0c1f4f; color: #fff; }
    .nav-in { max-width: 1110px; margin: 0 auto; padding: 0 20px; height: 60px; display: flex; align-items: center; justify-content: space-between; gap: 20px; }
    .brand { display: flex; align-items: center; gap: 12px; font-weight: 700; font-size: 17px; letter-spacing: .01em; white-space: nowrap; }
    .brand img { width: 34px; height: 34px; object-fit: contain; }
    .menu { display: flex; gap: 26px; }
    .menu a { padding: 6px 0; font-size: 14.5px; font-weight: 500; border-bottom: 2px solid transparent; }
    .menu a:hover { border-bottom-color: rgba(255,255,255,.5); }
    .menu a.aktif { border-bottom-color: #fff; font-weight: 600; }
    .btn-login { padding: 10px 18px; border-radius: 8px; background: #34498f; font-size: 14px; font-weight: 600; white-space: nowrap; }
    .btn-login:hover { background: #3e56a3; }

    /* ===== Hero ===== */
    .hero { background: linear-gradient(135deg, #0b2a66 0%, #1d46b8 60%, #2563eb 100%); color: #fff; text-align: center; padding: 64px 20px 56px; }
    .hero h1 { font-size: 30px; font-weight: 700; line-height: 1.2; }
    .hero h2 { margin-top: 4px; font-size: 17px; font-weight: 500; }
    .hero p { max-width: 640px; margin: 18px auto 0; font-size: 15px; line-height: 1.75; }

    /* ===== Daftar ekskul ===== */
    .daftar { max-width: 1180px; width: 100%; margin: 0 auto; padding: 56px 20px 70px; display: flex; flex-direction: column; gap: 36px; }
    .ekskul { display: grid; grid-template-columns: 34% 1fr; min-height: clamp(210px, 25vw, 330px); border-radius: 8px; overflow: hidden; }
    .ekskul img { width: 100%; height: 100%; object-fit: cover; display: block; background: #dfe5f3; }
    .ekskul .teks { display: flex; flex-direction: column; justify-content: center; padding: 28px clamp(20px, 4vw, 56px); }
    .ekskul h3 { font-size: clamp(20px, 2.2vw, 28px); font-weight: 700; line-height: 1.25; }
    .ekskul p { margin-top: 12px; font-size: clamp(13.5px, 1.2vw, 16px); line-height: 1.8; }

    .ekskul.terang { background: #dce3f6; color: #0f1f4d; }
    .ekskul.gelap  { background: #0a1f66; color: #fff; }
    .kosong { text-align: center; color: #9ca3af; font-size: 14px; padding: 40px 0; }

    /* ===== Footer ===== */
    .footer { background: #0b3f78; color: #fff; text-align: center; padding: 28px 20px; font-size: 13px; }

    @media (max-width: 860px) {
      .nav-in { height: auto; padding: 12px 20px; flex-wrap: wrap; justify-content: center; }
      .menu { flex-wrap: wrap; justify-content: center; gap: 8px 18px; order: 3; width: 100%; }
      .ekskul { grid-template-columns: 1fr; }
      .ekskul img { height: 220px; }
    }
  </style>
</head>
<body>

  {{-- ===== Navbar ===== --}}
  <header class="nav">
    <div class="nav-in">
      <a href="{{ url('/') }}" class="brand">
        <img src="{{ asset('images/logo sekolah.jpg') }}" alt="Logo SMKN 4 Bogor">
        SMKN 4 BOGOR
      </a>

      <nav class="menu" aria-label="Menu utama">
        @foreach ($menu as [$label, $alamat])
          <a href="{{ url($alamat) }}" class="{{ request()->is(trim($alamat, '/') ?: '/') ? 'aktif' : '' }}">{{ $label }}</a>
        @endforeach
      </nav>

      <a href="{{ url('/login') }}" class="btn-login">Login Admin</a>
    </div>
  </header>

  {{-- ===== Hero ===== --}}
  <section class="hero">
    <h1>Ektrakulikuler</h1>
    <h2>SMKN 4 BOGOR</h2>
    <p>Ekstrakurikuler adalah kegiatan di luar pembelajaran yang menjadi wadah bagi siswa untuk mengembangkan minat, bakat, kreativitas, serta kemampuan bekerja sama dan bertanggung jawab.</p>
  </section>

  {{-- ===== Daftar ekstrakurikuler (selang-seling terang dan gelap) ===== --}}
  <main class="daftar">
    @forelse ($daftar as $e)
      <article class="ekskul {{ $loop->odd ? 'terang' : 'gelap' }}">
        @if ($e['foto'])
          <img src="{{ $e['foto'] }}" alt="{{ $e['nama'] }}">
        @else
          <img src="" alt="" style="visibility:hidden">
        @endif
        <div class="teks">
          <h3>{{ $e['nama'] }}</h3>
          @if ($e['isi'])
            <p>{{ $e['isi'] }}</p>
          @endif
        </div>
      </article>
    @empty
      <p class="kosong">Belum ada ekstrakulikuler.</p>
    @endforelse
  </main>

  {{-- ===== Footer ===== --}}
  <footer class="footer">
    &copy; {{ date('Y') }} SMKN 4 Bogor. Semua Hak Cipta Dilindungi.
  </footer>

</body>
</html>