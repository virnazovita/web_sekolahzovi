@php
    // Nomor halaman yang ditampilkan (mengikuti jumlah halaman asli dari database)
    $sekarang = $daftarArtikel->currentPage();
    $terakhir = $daftarArtikel->lastPage();
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kelola Artikel - SMKN 4 Bogor</title>
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}?v=2">
  <style>
    /* Ukuran diukur dari desain Figma (lebar desain 1440px).
       "calc(var(--v) * 29)" = 29px di desain, ikut membesar/mengecil sesuai lebar layar.
       Mau semuanya lebih kecil/besar? Ubah angka 1440 pada --v (lebih besar = lebih kecil). */
    .art { --v: clamp(0.62px, calc(100vw / 1440), 1.5px); }

    .art-judul { font-size: calc(var(--v) * 29); font-weight: 700; line-height: 1.15; margin: 0; color: #111827; }
    .art-baris { display: flex; justify-content: space-between; align-items: center; gap: 16px; width: calc(var(--v) * 930); max-width: 100%; }
    .art-tambah { background: #0b5fe0; color: #fff; text-decoration: none; font-size: max(11px, calc(var(--v) * 10)); font-weight: 600; padding: calc(var(--v) * 9) calc(var(--v) * 16); border-radius: calc(var(--v) * 5); white-space: nowrap; }
    .art-crumb { margin: calc(var(--v) * 14) 0 calc(var(--v) * 60) calc(var(--v) * 15); font-size: max(11px, calc(var(--v) * 12)); color: #b4bac6; }
    .art-crumb a { color: #b4bac6; text-decoration: none; }
    .art-crumb b { color: #1d4ed8; font-weight: 700; }

    /* Kartu tabel: lebar & tinggi sesuai desain (915 x 671) */
    .art-kartu { width: calc(var(--v) * 915); max-width: 100%; min-height: calc(var(--v) * 671); margin-left: calc(var(--v) * 15);
                 background: #f7f8fc; border: 1px solid #e1e5f0; border-radius: calc(var(--v) * 8); overflow: hidden; display: flex; flex-direction: column; }
    .art-tabel { width: 100%; border-collapse: collapse; table-layout: fixed; }
    .art-tabel th { height: calc(var(--v) * 40); background: #eff2f9; text-align: left; font-size: max(9.5px, calc(var(--v) * 8)); letter-spacing: .07em; text-transform: uppercase; color: #5b6475; font-weight: 600; padding: 0; }
    .art-tabel td { padding: calc(var(--v) * 6.5) 0; border-top: 1px solid #e3e7f1; vertical-align: middle; font-size: max(11px, calc(var(--v) * 9.4)); color: #111827; }
    .art-tabel .k-foto { padding-left: calc(var(--v) * 65); }
    .art-tabel td.t-judul { font-weight: 500; padding-right: calc(var(--v) * 20); }
    .art-tabel td.t-tanggal { color: #4b5563; }

    .art-foto { width: calc(var(--v) * 49); height: calc(var(--v) * 49); min-width: 36px; min-height: 36px; border-radius: calc(var(--v) * 8); background: #dfe5f3 center / cover no-repeat; }
    .art-badge { display: inline-block; background: #dbe5fb; color: #2b5bd7; font-size: max(10px, calc(var(--v) * 8.5)); font-weight: 500; padding: calc(var(--v) * 3) calc(var(--v) * 12); border-radius: 999px; }

    .art-aksi { display: flex; gap: calc(var(--v) * 8); }
    .art-aksi form { margin: 0; }
    .art-ikon { width: calc(var(--v) * 28); height: calc(var(--v) * 28); min-width: 26px; min-height: 26px; display: inline-flex; align-items: center; justify-content: center; border-radius: calc(var(--v) * 7); padding: 0; cursor: pointer; }
    .art-ikon svg { width: 52%; height: 52%; fill: none; stroke: currentColor; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }
    .art-edit { background: #eef3ff; border: 1px solid #c9dafc; color: #2b5bd7; }
    .art-hapus { background: #fff0f0; border: 1px solid #f4c3c3; color: #dc2626; }

    .art-kosong { text-align: center; color: #9ca3af; padding: calc(var(--v) * 60) 0 !important; }
    .art-kaki { margin-top: auto; min-height: calc(var(--v) * 52); border-top: 1px solid #e3e7f1; display: flex; align-items: center; justify-content: center; padding: 6px 16px; }

    @media (max-width: 900px) { .art-kartu { width: 100%; margin-left: 0; } .art-crumb { margin-left: 0; } .art-tabel .k-foto { padding-left: 16px; } }
  </style>
</head>
<body>

<div class="layout">

  @include('admin-sidebar')

  {{-- ================= AREA UTAMA (kanan) ================= --}}
  <div class="main">

    <header class="topbar"></header>

    <section class="content art">

      <div class="art-baris">
        <h1 class="art-judul">Kelola Artikel</h1>
        <a href="{{ url('/dashboard/artikel/create') }}" class="art-tambah">+ Tambah Artikel</a>
      </div>
      <div class="art-crumb"><a href="{{ url('/dashboard') }}">Dashboard</a> / <b>Artikel</b></div>

      @if (session('sukses'))
        <div class="alert-sukses">{{ session('sukses') }}</div>
      @endif

      <div class="art-kartu">
        <table class="art-tabel">
          <colgroup>
            <col style="width:13.66%"><col style="width:42.19%"><col style="width:12.79%"><col style="width:16.17%"><col style="width:15.19%">
          </colgroup>
          <thead>
            <tr>
              <th class="k-foto">Foto</th>
              <th>Judul</th>
              <th>Kategori</th>
              <th>Tanggal</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($daftarArtikel as $a)
              <tr>
                <td class="k-foto">
                  @if (!empty($a['foto']))
                    <div class="art-foto" style="background-image:url('{{ asset('images/' . rawurlencode($a['foto'])) }}')"></div>
                  @else
                    <div class="art-foto"></div>
                  @endif
                </td>
                <td class="t-judul">{{ $a['judul'] }}</td>
                <td><span class="art-badge">{{ $a['kategori'] }}</span></td>
                <td class="t-tanggal">{{ \Illuminate\Support\Carbon::parse($a['tanggal'])->locale('id')->translatedFormat('d M Y') }}</td>
                <td>
                  <div class="art-aksi">
                    {{-- Edit --}}
                    <a href="{{ url('/dashboard/artikel/' . $a['id'] . '/edit') }}" class="art-ikon art-edit" title="Edit" aria-label="Edit artikel">
                      <svg viewBox="0 0 24 24"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
                    </a>

                    {{-- Hapus (dengan konfirmasi) --}}
                    <form action="{{ url('/dashboard/artikel/' . $a['id']) }}" method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus artikel ini?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="art-ikon art-hapus" title="Hapus" aria-label="Hapus artikel">
                        <svg viewBox="0 0 24 24"><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="art-kosong">Belum ada artikel.</td>
              </tr>
            @endforelse
          </tbody>
        </table>

        {{-- Strip bawah kartu: nomor halaman (1 2 3 ... 8) --}}
        <div class="art-kaki">
          @if ($terakhir > 1)
            @php
              $daftarHalaman = collect([1, $terakhir])
                  ->merge(range(max(1, $sekarang - 1), min($terakhir, $sekarang + 1)))
                  ->unique()
                  ->sort()
                  ->values();
            @endphp
            <div class="pagination">
              @php $sebelumnya = 0; @endphp
              @foreach ($daftarHalaman as $h)
                @if ($h - $sebelumnya > 1)
                  <span class="titik">...</span>
                @endif

                @if ($h == $sekarang)
                  <span class="hal aktif" aria-current="page">{{ $h }}</span>
                @else
                  <a href="{{ $daftarArtikel->url($h) }}" class="hal">{{ $h }}</a>
                @endif

                @php $sebelumnya = $h; @endphp
              @endforeach
            </div>
          @endif
        </div>
      </div>

    </section>
  </div>

</div>

</body>
</html>