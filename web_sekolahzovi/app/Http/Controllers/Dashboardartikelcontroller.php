<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardArtikelController extends Controller
{
    public function index()
    {
        $artikels = Artikel::latest()->paginate(8);

        return view('dashboard.artikel.index', compact('artikels'));
    }

    public function create()
    {
        return view('dashboard.artikel.form', ['artikel' => new Artikel]);
    }

    public function store(Request $request)
    {
        $data = $this->validasi($request, true);
        $data['foto'] = $request->file('foto')->store('artikel', 'public');

        Artikel::create($data);

        return redirect()->route('dashboard.artikel.index')->with('sukses', 'Artikel berhasil ditambahkan.');
    }

    public function edit(Artikel $artikel)
    {
        return view('dashboard.artikel.form', compact('artikel'));
    }

    public function update(Request $request, Artikel $artikel)
    {
        $data = $this->validasi($request, false);

        if ($request->hasFile('foto')) {
            $this->hapusFoto($artikel);
            $data['foto'] = $request->file('foto')->store('artikel', 'public');
        } else {
            unset($data['foto']);
        }

        $artikel->update($data);

        return redirect()->route('dashboard.artikel.index')->with('sukses', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Artikel $artikel)
    {
        $this->hapusFoto($artikel);
        $artikel->delete();

        return redirect()->route('dashboard.artikel.index')->with('sukses', 'Artikel berhasil dihapus.');
    }

    private function validasi(Request $request, bool $wajibFoto): array
    {
        return $request->validate([
            'judul'     => 'required|string|max:255',
            'kategori'  => 'required|string|max:100',
            'ringkasan' => 'required|string',
            'foto'      => [$wajibFoto ? 'required' : 'nullable', 'image', 'max:2048'],
        ]);
    }

    private function hapusFoto(Artikel $artikel): void
    {
        if (! str_starts_with($artikel->foto, 'images/')) {
            Storage::disk('public')->delete($artikel->foto);
        }
    }
}