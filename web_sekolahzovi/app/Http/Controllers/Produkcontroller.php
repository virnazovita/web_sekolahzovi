<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $kategoriList = Produk::query()->select('kategori')->distinct()->orderBy('kategori')->pluck('kategori');

        $daftarProduk = Produk::query()
            ->when($request->filled('kategori'), fn ($q) => $q->where('kategori', $request->kategori))
            ->latest('id')
            ->paginate(8)
            ->withQueryString();

        return view('produk.index', compact('daftarProduk', 'kategoriList'));
    }

    public function create()
    {
        return view('produk.form', [
            'produk'       => new Produk(['stok' => 'Tersedia']),
            'kategoriList' => $this->kategoriSaran(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validasi($request, true);
        $data['foto'] = $request->file('foto')->store('produk', 'public');

        Produk::create($data);

        return redirect()->route('produk.index')->with('sukses', 'Produk berhasil ditambahkan.');
    }

    public function edit(Produk $produk)
    {
        return view('produk.form', [
            'produk'       => $produk,
            'kategoriList' => $this->kategoriSaran(),
        ]);
    }

    public function update(Request $request, Produk $produk)
    {
        $data = $this->validasi($request, false);

        if ($request->hasFile('foto')) {
            Storage::disk('public')->delete($produk->foto);
            $data['foto'] = $request->file('foto')->store('produk', 'public');
        } else {
            unset($data['foto']);
        }

        $produk->update($data);

        return redirect()->route('produk.index')->with('sukses', 'Produk berhasil diperbarui.');
    }

    public function destroy(Produk $produk)
    {
        Storage::disk('public')->delete($produk->foto);
        $produk->delete();

        return redirect()->route('produk.index')->with('sukses', 'Produk berhasil dihapus.');
    }

    // Saran kategori di form: bawaan + yang sudah pernah dipakai
    private function kategoriSaran()
    {
        return collect(['Seragam', 'Wearpack', 'Batik', 'Aksesoris', 'Jasa'])
            ->merge(Produk::query()->distinct()->pluck('kategori'))
            ->unique()
            ->values();
    }

    private function validasi(Request $request, bool $fotoWajib): array
    {
        return $request->validate([
            'nama'      => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string', 'max:255'],
            'kategori'  => ['required', 'string', 'max:100'],
            'harga'     => ['required', 'integer', 'min:0'],
            'stok'      => ['required', 'in:Tersedia,Habis'],
            'foto'      => [$fotoWajib ? 'required' : 'nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ], [
            'nama.required'     => 'Nama produk wajib diisi.',
            'kategori.required' => 'Kategori wajib diisi.',
            'harga.required'    => 'Harga wajib diisi.',
            'harga.integer'     => 'Harga harus berupa angka tanpa titik atau koma.',
            'harga.min'         => 'Harga tidak boleh negatif.',
            'stok.required'     => 'Status stok wajib dipilih.',
            'stok.in'           => 'Status stok tidak valid.',
            'foto.required'     => 'Foto produk wajib diunggah.',
            'foto.image'        => 'File harus berupa gambar.',
            'foto.mimes'        => 'Foto harus berformat jpg, jpeg, png, atau webp.',
            'foto.max'          => 'Ukuran foto maksimal 2 MB.',
        ]);
    }
}