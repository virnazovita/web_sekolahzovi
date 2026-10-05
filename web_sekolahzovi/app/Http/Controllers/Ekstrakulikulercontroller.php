<?php

namespace App\Http\Controllers;

use App\Models\Ekstrakulikuler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EkstrakulikulerController extends Controller
{
    public function index()
    {
        // Urutan tampil = urutan data masuk
        $daftarEkskul = Ekstrakulikuler::orderBy('id')->paginate(8);

        return view('ekstrakulikuler.index', compact('daftarEkskul'));
    }

    public function create()
    {
        return view('ekstrakulikuler.form', ['ekskul' => new Ekstrakulikuler()]);
    }

    public function store(Request $request)
    {
        $data = $this->validasi($request, true);
        $data['foto'] = $request->file('foto')->store('ekstrakulikuler', 'public');

        Ekstrakulikuler::create($data);

        return redirect()->route('ekstrakulikuler.index')
            ->with('sukses', 'Ekstrakulikuler berhasil ditambahkan.');
    }

    public function edit(Ekstrakulikuler $ekstrakulikuler)
    {
        return view('ekstrakulikuler.form', ['ekskul' => $ekstrakulikuler]);
    }

    public function update(Request $request, Ekstrakulikuler $ekstrakulikuler)
    {
        $data = $this->validasi($request, false);

        if ($request->hasFile('foto')) {
            Storage::disk('public')->delete($ekstrakulikuler->foto);
            $data['foto'] = $request->file('foto')->store('ekstrakulikuler', 'public');
        } else {
            unset($data['foto']);
        }

        $ekstrakulikuler->update($data);

        return redirect()->route('ekstrakulikuler.index')
            ->with('sukses', 'Ekstrakulikuler berhasil diperbarui.');
    }

    public function destroy(Ekstrakulikuler $ekstrakulikuler)
    {
        Storage::disk('public')->delete($ekstrakulikuler->foto);
        $ekstrakulikuler->delete();

        return redirect()->route('ekstrakulikuler.index')
            ->with('sukses', 'Ekstrakulikuler berhasil dihapus.');
    }

    private function validasi(Request $request, bool $fotoWajib): array
    {
        return $request->validate([
            'nama'         => ['required', 'string', 'max:255'],
            'keterangan'   => ['nullable', 'string', 'max:255'],
            'pembina'      => ['required', 'string', 'max:255'],
            'hari_latihan' => ['required', 'string', 'max:255'],
            'foto'         => [$fotoWajib ? 'required' : 'nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ], [
            'nama.required'         => 'Nama ekstrakulikuler wajib diisi.',
            'pembina.required'      => 'Nama pembina wajib diisi.',
            'hari_latihan.required' => 'Hari latihan wajib diisi.',
            'foto.required'         => 'Foto atau logo wajib diunggah.',
            'foto.image'            => 'File harus berupa gambar.',
            'foto.mimes'            => 'Foto harus berformat jpg, jpeg, png, atau webp.',
            'foto.max'              => 'Ukuran foto maksimal 2 MB.',
        ]);
    }
}