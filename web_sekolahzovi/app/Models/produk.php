<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = ['nama', 'deskripsi', 'kategori', 'harga', 'stok', 'foto'];

    // Harga siap tampil, contoh: Rp 80.000
    protected function hargaRupiah(): Attribute
    {
        return Attribute::get(fn () => 'Rp ' . number_format((int) $this->harga, 0, ',', '.'));
    }

    // Alamat gambar yang siap dipakai di <img>
    protected function fotoUrl(): Attribute
    {
        return Attribute::get(fn () => $this->foto ? asset('storage/' . $this->foto) : null);
    }
}