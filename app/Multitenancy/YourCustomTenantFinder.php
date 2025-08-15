<?php

namespace App\Multitenancy;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Spatie\Multitenancy\Contracts\IsTenant;
use Spatie\Multitenancy\TenantFinder\TenantFinder;

class YourCustomTenantFinder extends TenantFinder
{
    public function findForRequest(Request $request): ?IsTenant
    {
        $host = $request->getHost();

        // PENGECEKAN BARU YANG PENTING:
        // Periksa apakah domain yang dikunjungi terdaftar sebagai 'central_domains'
        // di dalam file config/multitenancy.php.
        if ($this->isCentralDomain($host)) {
            // Jika ya, ini adalah domain landlord. Jangan cari tenant.
            return null;
        }

        // Jika bukan domain landlord, baru cari tenant di database.
        return Tenant::where('domain', $host)->first();
    }

    /**
     * Fungsi bantuan untuk memeriksa apakah sebuah host ada di dalam
     * daftar 'central_domains' dari file konfigurasi.
     */
    protected function isCentralDomain(string $host): bool
    {
        $centralDomains = config('multitenancy.central_domains', []);

        return in_array($host, $centralDomains);
    }
}
