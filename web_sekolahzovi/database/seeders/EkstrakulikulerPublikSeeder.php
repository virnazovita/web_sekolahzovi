<?php

namespace Database\Seeders;

use App\Models\Ekstrakulikuler;
use Illuminate\Database\Seeder;

/**
 * Mengisi deskripsi 6 ekstrakulikuler (teks yang selama ini tertulis langsung
 * di halaman /ekstrakulikuler) ke database, supaya bisa diedit lewat dashboard.
 * Deskripsi disimpan di kolom "keterangan". Foto, pembina, dan hari latihan tidak diubah.
 *
 * Jalankan SETELAH EkstrakulikulerSeeder:
 *   php artisan db:seed --class=EkstrakulikulerPublikSeeder
 */
class EkstrakulikulerPublikSeeder extends Seeder
{
    public function run(): void
    {
        // 'cari' = nama ekskul yang sekarang ada di dashboard, 'nama' = nama di halaman publik
        $data = [
            ['cari' => 'Paskibra',     'nama' => 'Paskibra',                  'isi' => 'Paskibra (Pasukan Pengibar Bendera) melatih kedisiplinan, kekompakan, dan jiwa nasionalisme melalui latihan baris-berbaris serta tugas pengibaran bendera pada upacara di sekolah.'],
            ['cari' => 'Pramuka',      'nama' => 'Pramuka',                   'isi' => 'Pramuka membentuk karakter siswa yang mandiri, peduli, dan bertanggung jawab lewat kegiatan kepanduan, perkemahan, serta latihan kepemimpinan dan kerja sama tim.'],
            ['cari' => 'PMR',          'nama' => 'Palang Merah Remaja (PMR)', 'isi' => 'PMR membekali siswa dengan keterampilan pertolongan pertama, pengetahuan kesehatan remaja, dan kepedulian sosial agar siap membantu sesama di lingkungan sekolah.'],
            ['cari' => 'Futsal',       'nama' => 'Futsal',                    'isi' => 'Futsal menjadi wadah bagi siswa yang gemar sepak bola untuk melatih teknik, kebugaran, dan sportivitas, sekaligus mengikuti berbagai pertandingan.'],
            ['cari' => 'Pencak Silat', 'nama' => 'Pencak Silat',              'isi' => 'Pencak Silat melatih bela diri tradisional Indonesia sekaligus membangun kedisiplinan, ketangguhan, dan sikap saling menghormati.'],
            ['cari' => 'DMV',          'nama' => 'Desain Media Visual (DMV)', 'isi' => 'DMV mengembangkan kreativitas siswa di bidang desain grafis, fotografi, dan video sehingga siswa dapat membuat karya visual untuk sekolah maupun portofolio pribadi.'],
        ];

        foreach ($data as $d) {
            $ekskul = Ekstrakulikuler::where('nama', $d['cari'])->orWhere('nama', $d['nama'])->first();

            if (! $ekskul) {
                $this->command?->warn("Ekskul '{$d['cari']}' belum ada di dashboard (dilewati). Jalankan EkstrakulikulerSeeder dulu.");
                continue;
            }

            $ekskul->update([
                'nama'       => $d['nama'],
                'keterangan' => $d['isi'],
            ]);

            $this->command?->info("OK: {$d['nama']}");
        }
    }
}