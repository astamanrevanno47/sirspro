<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sini kita mendefinisikan rute untuk aplikasi kita.
| Kita membaginya menjadi dua bagian: Rute Landlord (Publik)
| dan Rute Tenant (yang memerlukan proteksi middleware).
|
*/

// --- RUTE LANDLORD / PUBLIK ---
// Rute ini tidak menggunakan grup middleware 'tenant'.
// Cocok untuk landing page, halaman harga, atau halaman registrasi.
Route::get('/', function () {
    // DIUBAH: Menampilkan view 'welcome' yang sudah ada di proyek Anda.
    return view('welcome');
})->name('landlord.home');


// --- RUTE KHUSUS TENANT ---
// Semua rute di dalam grup ini akan dilindungi oleh middleware 'tenant'
// yang sudah kita daftarkan sebelumnya di bootstrap/app.php.
Route::middleware('tenant')->group(function () {

    // Halaman utama untuk setiap tenant akan menampilkan dashboard.
    // Contoh: tenant1.test/
    Route::get('/', [DashboardController::class, 'index'])->name('tenant.home');

    // Rute dashboard tenant.
    // Contoh: tenant1.test/dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('tenant.dashboard');

    // Anda bisa menambahkan rute-rute spesifik tenant lainnya di sini.
    // Contoh:
    // Route::get('/profile', [ProfileController::class, 'show'])->name('tenant.profile');
});
