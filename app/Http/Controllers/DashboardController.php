<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Tenant; // Pastikan model Tenant di-import
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard untuk tenant yang sedang aktif.
     */
    public function index()
    {
        // DIUBAH: Gunakan Tenant::current() untuk mendapatkan tenant yang aktif.
        // Ini adalah cara yang benar di luar halaman Filament.
        $currentTenant = Tenant::current();

        // Middleware "NeedsTenant" sudah memastikan tenant pasti ada.
        // Jika tidak ada, middleware akan menghentikan request sebelum sampai ke sini.
        // Jadi, kita bisa hapus pengecekan 'if (!$currentTenant)'.

        // Ambil produk yang hanya dimiliki oleh tenant ini
        $products = Product::where('tenant_id', $currentTenant->id)->get();

        // Kirim data tenant dan produk ke view 'dashboard'
        return view('dashboard', [
            'tenant' => $currentTenant,
            'products' => $products,
        ]);
    }
}
