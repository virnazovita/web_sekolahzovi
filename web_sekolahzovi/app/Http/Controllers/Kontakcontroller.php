<?php

namespace App\Http\Controllers;

use App\Models\PesanKontak;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function index()
    {
        $kontak = [
            'alamat' => 'Jl. Contoh Raya No. 4, Kota Bogor, Jawa Barat',
            'telepon' => '(0251) 123-4567',
            'email' => 'info@smkn4bogor.sch.id',
            'jam_operasional' => 'Senin - Jumat, 07.00 - 15.00 WIB',
        ];

        return view('kontak', compact('kontak'));
    }

    public function kirim(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email',
            'subjek' => 'required|string|max:150',
            'pesan' => 'required|string',
        ]);

        PesanKontak::create($data);

        return back()->with('sukses', 'Pesan Anda berhasil terkirim. Terima kasih!');
    }
}