{{--
  Ini file navbar SHARED — dipanggil dari semua halaman pakai @include('partials.navbar')
  Menu yang aktif otomatis ke-detect sendiri pakai request()->is(...), 
  jadi nggak perlu nulis class="active" manual di tiap halaman lagi.
--}}
<header class="navbar">
  <div class="navbar-inner">
    <div class="logo">
      <img src="{{ asset('assets/logo sekolah.jpg') }}" alt="Logo SMKN 4 Bogor" class="navbar-logo-img">
      <span class="logo-text">SMKN 4 BOGOR</span>
    </div>
    <nav class="nav-menu">
      <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a>
      <a href="{{ url('/profil') }}" class="{{ request()->is('profil') ? 'active' : '' }}">Profil</a>
      <a href="{{ url('/artikel') }}" class="{{ request()->is('artikel') ? 'active' : '' }}">Artikel</a>
      <a href="{{ url('/galeri') }}" class="{{ request()->is('galeri') ? 'active' : '' }}">Galeri</a>
      <a href="{{ url('/ekstrakulikuler') }}" class="{{ request()->is('ekstrakulikuler') ? 'active' : '' }}">Ekstrakulikuler</a>
      <a href="{{ url('/produk') }}" class="{{ request()->is('produk') ? 'active' : '' }}">Produk</a>
      <a href="{{ url('/kontak') }}" class="{{ request()->is('kontak') ? 'active' : '' }}">Kontak</a>
    </nav>
    @auth
      {{-- Sudah login: tombol berubah jadi Dashboard --}}
      <a href="{{ url('/dashboard') }}" class="btn-login">Dashboard</a>
    @else
      {{-- Belum login: tombol Login Admin --}}
      <a href="{{ url('/login') }}" class="btn-login">Login Admin</a>
    @endauth
  </div>
</header>