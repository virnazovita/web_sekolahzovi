<?php

use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\EkstrakulikulerController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\KontakPublikController;
use App\Http\Controllers\PesanKontakController;
use App\Http\Controllers\ProdukController;
use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Fluent;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ===== Halaman publik =====
// Halaman utama memakai view resources/views/beranda.blade.php.
// Artikel diambil dari database, jadi yang ditambah di admin langsung bisa tampil di sini
// lewat variabel $artikels.
Route::get('/', function () {
    $artikels = Artikel::latest('tanggal')->latest('id')->take(6)->get();

    return view('beranda', compact('artikels'));
})->name('home');

// Halaman publik lainnya (sesuai file di resources/views).
// Kalau ada yang tidak dipakai, hapus barisnya.
Route::view('/profil', 'profil')->name('profil');
Route::get('/artikel', function () {
    $artikels = Artikel::latest('tanggal')->latest('id')->get();

    return view('artikel', compact('artikels'));
})->name('artikel');
Route::view('/galeri', 'galeri')->name('galeri');

// SEMENTARA: tiga halaman ini butuh data dari route. Data aslinya belum dipasang,
// jadi dikirim kosong supaya halamannya terbuka tanpa error. Isi datanya menyusul.
Route::view('/produk', 'produk', ['daftarProduk' => []])->name('produk');
Route::view('/ekstrakulikuler', 'ekstrakulikuler', ['daftarEkskul' => []])->name('ekstrakulikuler');
Route::view('/kontak', 'kontak', ['kontak' => new Fluent()])->name('kontak');
Route::post('/kontak', [KontakPublikController::class, 'kirim'])->middleware('throttle:5,1')->name('kontak.kirim');

// ===== Tamu (belum login) =====
Route::middleware('guest')->group(function () {

    Route::get('/login', fn () => view('auth.login'))->name('login');

    Route::post('/login', function (Request $request) {
        $credentials = $request->validate([
            'email'    => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'email.required'    => 'Nama pengguna atau email wajib diisi.',
            'password.required' => 'Kata sandi wajib diisi.',
        ]);

        // Boleh login pakai email ATAU nama pengguna (kolom `name` di tabel users)
        $login = $credentials['email'];
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        if (Auth::attempt([$field => $login, 'password' => $credentials['password']], $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        return back()
            ->withErrors(['email' => 'Email atau kata sandi salah.'])
            ->onlyInput('email');
    })->name('login.process');
});

// ===== Sudah login (admin) =====
Route::middleware('auth')->group(function () {

    // Ganti 'dashboard' dengan nama view dashboard-mu kalau berbeda
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');

    Route::post('/logout', function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    })->name('logout');

    // Artikel -> /dashboard/artikel (nama route: admin.artikel.*)
    Route::prefix('dashboard')->name('admin.')->group(function () {
        Route::resource('artikel', ArtikelController::class)->except('show');
    });

    // Galeri -> /dashboard/galeri (nama route: galeri.*, sesuai view galeri yang sudah dibuat)
    Route::prefix('dashboard')->group(function () {
        Route::resource('galeri', GaleriController::class)->except('show');
    });

    // Produk -> /dashboard/produk (nama route: produk.*)
    Route::prefix('dashboard')->group(function () {
        Route::resource('produk', ProdukController::class)->except('show');
    });

    // Ekstrakulikuler -> /dashboard/ekstrakulikuler (nama route: ekstrakulikuler.*)
    Route::prefix('dashboard')->group(function () {
        Route::resource('ekstrakulikuler', EkstrakulikulerController::class)->except('show');
    });

    // Kontak (pesan masuk) -> /dashboard/kontak (nama route: kontak.index, kontak.destroy)
    Route::prefix('dashboard')->group(function () {
        Route::resource('kontak', PesanKontakController::class)
            ->only(['index', 'destroy'])
            ->parameters(['kontak' => 'pesanKontak']);
    });

    // Kontak: detail & balas pesan -> /dashboard/kontak/{id}
    Route::prefix('dashboard')->group(function () {
        Route::get('kontak/{pesanKontak}', [PesanKontakController::class, 'show'])->name('kontak.show');
        Route::post('kontak/{pesanKontak}/balas', [PesanKontakController::class, 'balas'])->name('kontak.balas');
    });
});