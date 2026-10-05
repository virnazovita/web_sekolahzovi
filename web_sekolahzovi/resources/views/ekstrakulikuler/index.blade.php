@extends('layouts.admin')

@section('title', 'Kelola Ekstrakulikuler')

@push('styles')
<style>
  .ek-foto { width: calc(var(--v) * 80); height: calc(var(--v) * 50); min-width: 64px; min-height: 40px; border-radius: 6px; background: #dfe5f3 center / cover no-repeat; }
  .ek-nama { font-weight: 700; }
  .ek-ket { margin-top: 2px; font-size: 11px; color: #6b7280; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
  .ek-pembina { color: #1f2937; padding-right: 12px; }
  .ek-hari { display: inline-block; background: #e8eefb; color: #374151; font-size: 11px; font-weight: 500; padding: 4px 12px; border-radius: 999px; }
</style>
@endpush

@section('content')
@php
    $sekarang = $daftarEkskul->currentPage();
    $terakhir = $daftarEkskul->lastPage();
@endphp

<div class="art">

  <div class="art-head">
    <div>
      <h1 class="art-judul">Kelola Ekstrakulikuler</h1>
      <div class="art-crumb"><a href="{{ url('/dashboard') }}">Dashboard</a> / <b>Ekstrakulikuler</b></div>
    </div>

    <a href="{{ route('ekstrakulikuler.create') }}" class="art-tombol">
      <svg viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></svg>
      Tambah Ekstrakulikuler
    </a>
  </div>

  @if (session('sukses'))
    <div class="alert-sukses">{{ session('sukses') }}</div>
  @endif

  <div class="art-kartu">
    <table class="art-tabel">
      <colgroup>
        <col style="width:17%"><col style="width:28%"><col style="width:22%"><col style="width:21%"><col style="width:12%">
      </colgroup>
      <thead>
        <tr>
          <th class="k-foto">Logo / Foto</th>
          <th>Nama Ekstrakulikuler</th>
          <th>Pembina</th>
          <th>Hari Latihan</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($daftarEkskul as $e)
          <tr>
            <td class="k-foto">
              <div class="ek-foto" @if ($e->foto_url) style="background-image:url('{{ $e->foto_url }}')" @endif></div>
            </td>
            <td>
              <div class="ek-nama">{{ $e->nama }}</div>
              @if ($e->keterangan)
                <div class="ek-ket">{{ $e->keterangan }}</div>
              @endif
            </td>
            <td class="ek-pembina">{{ $e->pembina }}</td>
            <td><span class="ek-hari">{{ $e->hari_latihan }}</span></td>
            <td>
              <div class="art-aksi">
                <a href="{{ route('ekstrakulikuler.edit', $e) }}" class="art-ikon art-edit" title="Edit" aria-label="Edit ekstrakulikuler">
                  <svg viewBox="0 0 24 24"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
                </a>
                <form action="{{ route('ekstrakulikuler.destroy', $e) }}" method="POST"
                      onsubmit="return confirm('Yakin ingin menghapus ekstrakulikuler ini?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="art-ikon art-hapus" title="Hapus" aria-label="Hapus ekstrakulikuler">
                    <svg viewBox="0 0 24 24"><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg>
                  </button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="art-kosong">Belum ada ekstrakulikuler.</td>
          </tr>
        @endforelse
      </tbody>
    </table>

    <div class="art-kaki">
      @if ($terakhir > 1)
        @php
          $daftarHalaman = collect([1, $terakhir])
              ->merge(range(max(1, $sekarang - 1), min($terakhir, $sekarang + 1)))
              ->unique()->sort()->values();
          $sebelumnya = 0;
        @endphp
        <div class="pagination">
          @foreach ($daftarHalaman as $h)
            @if ($h - $sebelumnya > 1) <span class="titik">...</span> @endif
            @if ($h == $sekarang)
              <span class="hal aktif" aria-current="page">{{ $h }}</span>
            @else
              <a href="{{ $daftarEkskul->url($h) }}" class="hal">{{ $h }}</a>
            @endif
            @php $sebelumnya = $h; @endphp
          @endforeach
        </div>
      @endif
    </div>
  </div>

</div>
@endsection