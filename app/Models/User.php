<?php

namespace App\Models;

use Filament\Models\Contracts\HasTenants;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Spatie\Permission\Traits\HasRoles;

// Kita kembali ke versi sederhana yang hanya mengimplementasikan HasTenants
class User extends Authenticatable implements HasTenants
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // --- FUNGSI UNTUK MULTI-TENANCY FILAMENT ---

    public function tenants(): BelongsToMany
    {
        // Relasi ini hanya untuk Super Admin
        return $this->belongsToMany(\App\Models\Tenant::class, 'tenant_user');
    }

    public function getTenants(Panel $panel): Collection
    {
        return $this->tenants;
    }

    public function canAccessTenant(Model $tenant): bool
    {
        // Logika ini hanya untuk Super Admin
        return $this->tenants->contains($tenant);
    }
}
