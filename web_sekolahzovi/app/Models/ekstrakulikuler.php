<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Ekstrakulikuler extends Model
{
    protected $table = 'ekstrakulikulers';

    protected $fillable = ['nama', 'keterangan', 'pembina', 'hari_latihan', 'foto'];

    // Alamat gambar yang siap dipakai di <img> / background-image
    protected function fotoUrl(): Attribute
    {
        return Attribute::get(fn () => $this->foto ? asset('storage/' . $this->foto) : null);
    }
}