<?php

use App\Models\Tenant;
use App\Multitenancy\YourCustomTenantFinder;
use Spatie\Multitenancy\Actions\ForgetCurrentTenantAction;
use Spatie\Multitenancy\Actions\MakeQueueTenantAwareAction;
use Spatie\Multitenancy\Actions\MakeTenantCurrentAction;
use Spatie\Multitenancy\Actions\MigrateTenantAction;
use Spatie\Multitenancy\Tasks\SwitchTenantDatabaseTask;

return [
    'tenant_finder' => YourCustomTenantFinder::class,

    'tenant_artisan_search_fields' => [
        'id',
        'domain',
    ],

    /*
    |--------------------------------------------------------------------------
    | Switch Tenant Tasks
    |--------------------------------------------------------------------------
    |
    | Ini adalah perubahan yang paling penting. Dengan menambahkan
    | ['reconnect' => true], kita secara paksa memberitahu aplikasi:
    | "Setiap kali berganti tenant, putuskan koneksi database yang lama
    | dan buat koneksi yang benar-benar baru ke database tenant yang benar."
    | Ini akan menyelesaikan masalah kebocoran data antar tenant.
    |
    */
    'switch_tenant_tasks' => [
        [SwitchTenantDatabaseTask::class => ['reconnect' => true]],
    ],

    'tenant_model' => Tenant::class,

    'queues_are_tenant_aware_by_default' => true,

    'tenant_database_connection_name' => 'tenant',

    'landlord_database_connection_name' => 'landlord',

    'central_domains' => [
        'sirspro.test',
    ],

    // ... sisa konfigurasi biarkan seperti sebelumnya ...
    'current_tenant_context_key' => 'tenantId',
    'current_tenant_container_key' => 'currentTenant',
    'shared_routes_cache' => false,
    'actions' => [
        'make_tenant_current_action' => MakeTenantCurrentAction::class,
        'forget_current_tenant_action' => ForgetCurrentTenantAction::class,
        'make_queue_tenant_aware_action' => MakeQueueTenantAwareAction::class,
        'migrate_tenant' => MigrateTenantAction::class,
    ],
    'tenant_aware_jobs' => [],
    'not_tenant_aware_jobs' => [],
];
