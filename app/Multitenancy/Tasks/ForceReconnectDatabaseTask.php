<?php

namespace App\Multitenancy\Tasks;

use Illuminate\Support\Facades\DB;
use Spatie\Multitenancy\Contracts\IsTenant;
use Spatie\Multitenancy\Tasks\SwitchTenantTask;

class ForceReconnectDatabaseTask implements SwitchTenantTask
{
    public function makeCurrent(IsTenant $tenant): void
    {
        $this->reconnect($tenant);
    }

    public function forgetCurrent(): void
    {
        // Tidak perlu melakukan apa-apa saat melupakan tenant
    }

    protected function reconnect(IsTenant $tenant): void
    {
        $connectionName = config('multitenancy.tenant_database_connection_name');

        // 1. Putuskan koneksi lama yang mungkin masih "terjebak"
        DB::purge($connectionName);

        // 2. Atur nama database yang benar untuk koneksi tenant
        config()->set("database.connections.{$connectionName}.database", $tenant->database);

        // 3. Buat koneksi yang benar-benar baru
        DB::reconnect($connectionName);
    }
}
