<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Admin') - SMKN 4 Bogor</title>
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
  @stack('styles')
</head>
<body>

@php $ik = 'fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"'; @endphp

<div class="layout">

  <aside class="sidebar">
    <div class="sb-merek">
      <img src="{{ asset('images/logo sekolah.jpg') }}" alt="Logo" width="36" height="36">
      <div><b>SMKN 4 BOGOR</b><small>ADMIN DASHBOARD</small></div>
    </div>

    <nav class="sb-menu">
      <a href="{{ url('/dashboard') }}" class="{{ request()->is('dashboard') ? 'aktif' : '' }}">
        <svg {!! $ik !!}><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>Dashboard</a>
      <a href="{{ url('/dashboard/artikel') }}" class="{{ request()->is('dashboard/artikel*') ? 'aktif' : '' }}">
        <svg {!! $ik !!}><rect x="3" y="4" width="18" height="17" rx="2"/><path d="M3 10h18M8 2v4M16 2v4"/></svg>Artikel</a>
      <a href="{{ url('/dashboard/galeri') }}" class="{{ request()->is('dashboard/galeri*') ? 'aktif' : '' }}">
        <svg {!! $ik !!}><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-5-5L5 21"/></svg>Galeri</a>
      <a href="{{ url('/dashboard/produk') }}" class="{{ request()->is('dashboard/produk*') ? 'aktif' : '' }}">
        <svg {!! $ik !!}><path d="M3 11v2l14 5V6L3 11Z"/><path d="M7 14v4a2 2 0 0 0 4 0"/></svg>Produk</a>
      <a href="{{ url('/dashboard/ekstrakulikuler') }}" class="{{ request()->is('dashboard/ekstrakulikuler*') ? 'aktif' : '' }}">
        <svg {!! $ik !!}><circle cx="9" cy="8" r="3"/><path d="M3 20a6 6 0 0 1 12 0"/><path d="M17 11a3 3 0 1 0 0-6M21 20a5 5 0 0 0-4-5"/></svg>Ekstrakulikuler</a>
    </nav>

    <form class="sb-keluar" method="POST" action="{{ url('/logout') }}">
      @csrf
      <button type="submit">
        <svg {!! $ik !!}><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4M16 17l5-5-5-5M21 12H9"/></svg>Logout</button>
    </form>
  </aside>

  <div class="main">
    <header class="topbar"></header>

    <section class="content">
      @yield('content')
    </section>
  </div>

</div>

</body>
</html>