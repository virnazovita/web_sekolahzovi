<?php

namespace Database\Seeders;

use App\Models\Ekstrakulikuler;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Mengisi Kelola Ekstrakulikuler dengan foto-foto ekskul.
 * Foto asli dicari di folder public (lihat $folderSumber), lalu disalin
 * ke storage/app/public/ekstrakulikuler supaya tampil lewat fitur Kelola Ekstrakulikuler.
 *
 * Jalankan:  php artisan db:seed --class=EkstrakulikulerSeeder
 */
class EkstrakulikulerSeeder extends Seeder
{
    // Folder (di dalam public/) tempat file foto berada. Dicari berurutan.
    private array $folderSumber = ['images', 'assets', 'images/ekskul', 'ekskul', ''];

    public function run(): void
    {
        // Urutan tampil = urutan di bawah ini (dari atas ke bawah).
        // GANTI nama pembina dan hari latihan sesuai data yang sebenarnya.
        $data = [
            ['file' => 'eskul pramuka.jpg', 'nama' => 'Pramuka', 'pembina' => 'Pembina Pramuka', 'hari_latihan' => 'Senin & Rabu, 16.00'],
            ['file' => 'eskul futsal.jpg',  'nama' => 'Futsal',  'pembina' => 'Ade Eka Sastra',  'hari_latihan' => 'Kamis & Sabtu, 15.30'],
            ['file' => 'eskul pmr.jpg',     'nama' => 'PMR',     'pembina' => 'Pembina PMR',     'hari_latihan' => 'Sabtu, 08.00 - 11.00'],
            ['file' => 'eskul paskib.jpg',  'nama' => 'Paskibra', 'pembina' => 'Pembina Paskibra', 'hari_latihan' => 'Jumat, 15.30'],
            ['file' => 'eskul.silat.jpg',   'nama' => 'Pencak Silat', 'pembina' => 'Pembina Pencak Silat', 'hari_latihan' => 'Selasa & Kamis, 15.30'],
            ['file' => 'eskul dmv.jpg',     'nama' => 'DMV',     'pembina' => 'Pembina DMV',     'hari_latihan' => 'Rabu, 15.30'],
        ];

        foreach ($data as $e) {
            $sumber = $this->cariFile($e['file']);

            if (! $sumber) {
                $this->command?->warn("Foto tidak ditemukan: {$e['file']} ('{$e['nama']}' dilewati)");
                continue;
            }

            $tujuan = 'ekstrakulikuler/'
                . Str::slug(pathinfo($e['file'], PATHINFO_FILENAME)) . '.'
                . strtolower(pathinfo($e['file'], PATHINFO_EXTENSION));

            Storage::disk('public')->put($tujuan, File::get($sumber));

            Ekstrakulikuler::updateOrCreate(
                ['nama' => $e['nama']],
                [
                    'keterangan'   => 'Pilihan',
                    'pembina'      => $e['pembina'],
                    'hari_latihan' => $e['hari_latihan'],
                    'foto'         => $tujuan,
                ]
            );

            $this->command?->info("OK: {$e['nama']}");
        }
    }

    private function cariFile(string $nama): ?string
    {
        foreach ($this->folderSumber as $folder) {
            $path = public_path(trim($folder . '/' . $nama, '/'));
            if (is_file($path)) {
                return $path;
            }
        }

        return null;
    }
}