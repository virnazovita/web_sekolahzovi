@extends('layouts.admin')

@php
    $edit      = $ekskul->exists;
    $punyaFoto = $edit && $ekskul->foto_url;
@endphp

@section('title', $edit ? 'Edit Ekstrakulikuler' : 'Tambah Ekstrakulikuler')

@push('styles')
<style>
  .ef-sub { margin: 6px 0 0 calc(var(--v) * 15); color: #6b7280; font-size: 13.5px; }
  .ef-kartu { width: calc(var(--v) * 921); max-width: 100%; margin: calc(var(--v) * 36) 0 0 calc(var(--v) * 15); padding: 28px; background: #f7f8fc; border: 1px solid #e1e5f0; border-radius: 12px; }
  .ef-grid { display: grid; grid-template-columns: 260px 1fr; gap: 28px; align-items: start; }
  .ef-label { display: block; margin-bottom: 8px; font-size: 12px; font-weight: 700; color: #111827; }
  .ef-input { display: block; width: 100%; height: 40px; padding: 0 12px; border: 1px solid #d9dee9; border-radius: 8px; background: #fff; font: inherit; font-size: 13px; color: #111827; outline: none; }
  .ef-input:focus { border-color: #284686; box-shadow: 0 0 0 3px rgba(40, 70, 134, .15); }
  .ef-kolom { margin-top: 18px; }
  .ef-err { margin-top: 5px; color: #dc2626; font-size: 12px; }
  .ef-alert { background: #fdecec; color: #b42318; border-radius: 8px; padding: 10px 14px; font-size: 12.5px; font-weight: 600; margin-bottom: 18px; }

  .ef-drop { position: relative; height: 170px; display: flex; align-items: center; justify-content: center; border: 1.5px dashed #aab3c8; border-radius: 10px; background: #fff; cursor: pointer; overflow: hidden; text-align: center; }
  .ef-drop:hover, .ef-drop.seret { border-color: #284686; background: #eef3ff; }
  .ef-drop-isi { padding: 0 12px; color: #6b7280; font-size: 12px; }
  .ef-drop-isi svg { width: 28px; height: 28px; display: block; margin: 0 auto 8px; color: #374151; }
  .ef-drop-isi small { display: block; margin-top: 6px; font-size: 10.5px; color: #9aa1b2; }
  .ef-drop img { display: none; position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; }
  .ef-ganti { display: none; position: absolute; left: 50%; bottom: 8px; transform: translateX(-50%); padding: 4px 12px; border-radius: 999px; background: rgba(17, 24, 39, .72); color: #fff; font-size: 11px; white-space: nowrap; }
  .ef-drop.ada-foto img, .ef-drop.ada-foto .ef-ganti { display: block; }
  .ef-drop.ada-foto .ef-drop-isi { display: none; }

  .ef-aksi { display: flex; justify-content: flex-end; gap: 10px; margin-top: 26px; padding-top: 20px; border-top: 1px solid #e3e7f1; }
  .ef-btn { height: 38px; padding: 0 20px; display: inline-flex; align-items: center; gap: 8px; border: 1px solid transparent; border-radius: 8px; font: inherit; font-size: 12.5px; font-weight: 600; text-decoration: none; cursor: pointer; }
  .ef-btn svg { width: 14px; height: 14px; fill: none; stroke: currentColor; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }
  .ef-batal { background: #fff; border-color: #d9dee9; color: #111827; }
  .ef-batal:hover { background: #f3f4f8; }
  .ef-simpan { background: #284686; color: #fff; }
  .ef-simpan:hover { background: #1f3a73; }

  @media (max-width: 900px) {
    .ef-kartu { width: 100%; margin-left: 0; }
    .ef-sub { margin-left: 0; }
    .ef-grid { grid-template-columns: 1fr; }
  }
</style>
@endpush

@section('content')
<div class="art">
  <h1 class="art-judul">{{ $edit ? 'Edit Ekstrakulikuler' : 'Tambah Ekstrakulikuler' }}</h1>
  <p class="ef-sub">{{ $edit ? 'Perbarui data kegiatan ekstrakulikuler' : 'Masukkan data kegiatan ekstrakulikuler baru' }}</p>

  <form id="formEkskul" class="ef-kartu" method="POST" enctype="multipart/form-data"
        action="{{ $edit ? route('ekstrakulikuler.update', $ekskul) : route('ekstrakulikuler.store') }}">
    @csrf
    @if ($edit)
      @method('PUT')
    @endif

    @if ($errors->any())
      <div class="ef-alert" role="alert">Data belum lengkap. Periksa kolom yang ditandai di bawah.</div>
    @endif

    <div class="ef-grid">
      <div>
        <span class="ef-label">Logo / Foto</span>
        <div class="ef-drop {{ $punyaFoto ? 'ada-foto' : '' }}" id="drop" tabindex="0" role="button" aria-label="Unggah logo atau foto">
          <img id="dzImg" alt="Pratinjau foto" @if ($punyaFoto) src="{{ $ekskul->foto_url }}" @endif>
          <div class="ef-drop-isi">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 18a4 4 0 0 1-.6-7.96A5.5 5.5 0 0 1 17 8.5a4.5 4.5 0 0 1 .5 9.5"/><path d="M12 12v8M9 15l3-3 3 3"/></svg>
            <b>Upload a file</b> or drag and drop
            <small>JPG, PNG, WEBP up to 2MB</small>
          </div>
          <span class="ef-ganti">Klik atau seret untuk mengganti foto</span>
        </div>
        <input type="file" id="foto" name="foto" accept="image/jpeg,image/png,image/webp" hidden>
        @error('foto') <div class="ef-err">{{ $message }}</div> @enderror
      </div>

      <div>
        <label class="ef-label" for="nama">Nama Ekstrakulikuler</label>
        <input type="text" id="nama" name="nama" class="ef-input" maxlength="255"
               placeholder="Contoh: Pramuka" value="{{ old('nama', $ekskul->nama) }}">
        @error('nama') <div class="ef-err">{{ $message }}</div> @enderror

        <div class="ef-kolom">
          <label class="ef-label" for="keterangan">Deskripsi (opsional, tampil di halaman Ekstrakulikuler)</label>
          <textarea id="keterangan" name="keterangan" class="ef-input" maxlength="255" rows="4"
                    style="height:auto;padding:10px 12px;line-height:1.6;resize:vertical"
                    placeholder="Jelaskan kegiatan ekstrakulikuler ini (maksimal 255 karakter)">{{ old('keterangan', $ekskul->keterangan) }}</textarea>
          @error('keterangan') <div class="ef-err">{{ $message }}</div> @enderror
        </div>

        <div class="ef-kolom">
          <label class="ef-label" for="pembina">Pembina</label>
          <input type="text" id="pembina" name="pembina" class="ef-input" maxlength="255"
                 placeholder="Nama pembina" value="{{ old('pembina', $ekskul->pembina) }}">
          @error('pembina') <div class="ef-err">{{ $message }}</div> @enderror
        </div>

        <div class="ef-kolom">
          <label class="ef-label" for="hari_latihan">Hari Latihan</label>
          <input type="text" id="hari_latihan" name="hari_latihan" class="ef-input" maxlength="255"
                 placeholder="Contoh: Senin &amp; Rabu, 16.00" value="{{ old('hari_latihan', $ekskul->hari_latihan) }}">
          @error('hari_latihan') <div class="ef-err">{{ $message }}</div> @enderror
        </div>
      </div>
    </div>

    <div class="ef-aksi">
      <a href="{{ route('ekstrakulikuler.index') }}" class="ef-btn ef-batal">Batal</a>
      <button type="submit" class="ef-btn ef-simpan">
        <svg viewBox="0 0 24 24"><path d="M5 3h11l3 3v14a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1Z"/><path d="M8 3v6h8V3M8 21v-7h8v7"/></svg>
        Simpan
      </button>
    </div>
  </form>
</div>

<script>
(function () {
  var drop = document.getElementById('drop'), input = document.getElementById('foto'), img = document.getElementById('dzImg');

  function tampil(file) {
    if (!file || file.type.indexOf('image/') !== 0) return;
    var r = new FileReader();
    r.onload = function (e) { img.src = e.target.result; drop.classList.add('ada-foto'); };
    r.readAsDataURL(file);
  }

  drop.addEventListener('click', function () { input.click(); });
  drop.addEventListener('keydown', function (e) {
    if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); input.click(); }
  });
  input.addEventListener('change', function () { tampil(input.files[0]); });
  ['dragenter', 'dragover'].forEach(function (n) {
    drop.addEventListener(n, function (e) { e.preventDefault(); drop.classList.add('seret'); });
  });
  ['dragleave', 'drop'].forEach(function (n) {
    drop.addEventListener(n, function (e) { e.preventDefault(); drop.classList.remove('seret'); });
  });
  drop.addEventListener('drop', function (e) {
    if (e.dataTransfer.files.length) { input.files = e.dataTransfer.files; tampil(input.files[0]); }
  });
})();
</script>
@endsection