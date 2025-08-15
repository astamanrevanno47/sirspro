<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KaryawanResource\Pages;
use App\Models\Karyawan;
use App\Models\Tenant; // Pastikan ini di-import
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class KaryawanResource extends Resource
{
    protected static ?string $model = Karyawan::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    // --- LOGIKA NAVIGASI BARU ---

    // 1. Memberitahu Filament untuk menempatkan menu ini di grup "Sumber Daya Manusia"
    protected static ?string $navigationGroup = 'Sumber Daya Manusia';

    // 2. Logika untuk menampilkan menu ini secara dinamis
    public static function canViewAny(): bool
    {
        // Menu ini hanya akan tampil jika tenant yang aktif
        // memiliki akses ke modul 'Data HRD'.
        return Tenant::current()?->hasModule('Data HRD') ?? false;
    }

    public static function form(Form $form): Form
    {
        // Form definition (akan kita isi nanti)
        return $form->schema([]);
    }

    public static function table(Table $table): Table
    {
        // Table definition (akan kita isi nanti)
        return $table->columns([])->actions([
            Tables\Actions\EditAction::make(),
        ]);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKaryawans::route('/'),
            'create' => Pages\CreateKaryawan::route('/create'),
            'edit' => Pages\EditKaryawan::route('/{record}/edit'),
        ];
    }    
}
