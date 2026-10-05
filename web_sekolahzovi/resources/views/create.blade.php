@extends('artikel.layout')

@section('title', 'Tambah Artikel')

@section('content')
    <div class="kepala-halaman">
        <div>
            <h1 class="judul-halaman">Tambah Artikel Baru</h1>
            <p class="sub-halaman">Masukkan informasi detail untuk artikel yang akan dipublikasikan</p>
        </div>
    </div>

    @include('artikel._form', [
        'artikel' => null,
        'action'  => route('admin.artikel.store'),
        'method'  => 'POST',
        'tombol'  => 'Simpan Artikel',
    ])
@endsection