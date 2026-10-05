<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $judul }} - SMKN 4 Bogor</title>
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}?v=2">
</head>
<body>
<div class="layout">
  @include('admin-sidebar')
  <div class="main">
    <header class="topbar"><span class="aktif">{{ $judul }}</span></header>
    <section class="content">
      <h1 style="font-size:28px;margin:0 0 8px">Kelola {{ $judul }}</h1>
      <p style="color:#6b7280;font-size:14px">Halaman ini sedang dalam pengerjaan.</p>
    </section>
  </div>
</div>
</body>
</html>