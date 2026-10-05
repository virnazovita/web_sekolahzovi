<?php

namespace App\Http\Controllers;

use App\Models\Artikel;

class DashboardController extends Controller
{
    public function index()
    {
        // ------------------------------------------------------------
        // 4 kartu statistik. Urutan menentukan ikon: 1=grup orang,
        // 2=orang+suara, 3=pintu, 4=kalender (lihat dashboard.blade.php).
        //
        // Jumlah Artikel sudah dihitung asli dari tabel artikels.
        // Produk, Galeri, dan Ekstrakurikuler masih ANGKA CONTOH karena
        // tabel/modelnya belum kita buat. Nanti kalau sudah ada,
        // ganti angkanya jadi hitungan asli, contoh:
        //   'jumlah' => \App\Models\Produk::count(),
        // ------------------------------------------------------------
        $statistik = [
            ['label' => 'Jumlah Artikel',     'jumlah' => 4,                'link' => '/artikel'],
            ['label' => 'Jumlah Produk',     'jumlah' => 8,                'link' => '/produk'],
            ['label' => 'Jumlah Galeri',     'jumlah' => 9,                'link' => '/galeri'],
            ['label' => 'Ekstrakurikuler',   'jumlah' => 6,                'link' => '/ekstrakulikuler'],
        ];

        // ------------------------------------------------------------
        // Aktivitas terkini (CONTOH). Nanti bisa diambil dari database.
        // ------------------------------------------------------------
        $aktivitas = [
            ['keterangan' => 'Admin mengubah artikel',      'judul' => 'Upacara Memperingati Hari Kemerdekaan', 'waktu' => '3 jam yang lalu'],
            ['keterangan' => 'Foto baru diunggah ke galeri', 'judul' => 'Ekstrakurikuler',                       'waktu' => '5 jam yang lalu'],
            ['keterangan' => 'Produk Baru Sekolah',          'judul' => 'Dapet Baru Stoknya',                    'waktu' => '2 jam yang lalu'],
        ];

        return view('dashboard', compact('statistik', 'aktivitas'));
    }
}