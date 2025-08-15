<?php

namespace App\Models;

use App\Models\Module;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB; // <-- Import baru
use Spatie\Multitenancy\Models\Tenant as BaseTenant;

class Tenant extends BaseTenant
{
    use HasFactory;

    protected $fillable = [
        'name',
        'domain',
        'database',
    ];

    // --- PENAMBAHAN PENTING ---
    // Ini adalah "lifecycle hook" dari Eloquent. Kode di dalam method booted()
    // akan dijalankan secara otomatis pada event-event tertentu.
    protected static function booted(): void
    {
        // Event "creating" akan berjalan tepat sebelum tenant baru disimpan ke database.
        static::creating(function (Tenant $tenant) {
            // Membuat nama database baru berdasarkan nama tenant yang aman untuk URL.
            // Contoh: "RS LNG BADAK" -> "rs_lng_badak"
            $dbName = 'db_' . str($tenant->name)->slug('_');
            $tenant->database = $dbName;

            // Menjalankan perintah SQL untuk membuat database baru.
            DB::connection('landlord')->statement("CREATE DATABASE `{$dbName}`");
        });
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function modules(): BelongsToMany
    {
        return $this->belongsToMany(Module::class, 'module_tenant');
    }

    public function hasModule(string $moduleName): bool
    {
        return $this->modules()->where('name', $moduleName)->exists();
    }
}
