<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PenilaianKpiTahunanResource\Pages;
use App\Filament\Resources\PenilaianKpiTahunanResource\RelationManagers;
use App\Models\PenilaianKpiTahunan; // Pastikan Anda sudah membuat model ini
use App\Models\Tenant; // Pastikan ini di-import
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PenilaianKpiTahunanResource extends Resource
{
    protected static ?string $model = PenilaianKpiTahunan::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    // --- LOGIKA NAVIGASI ---

    // 1. Mengelompokkan menu ini di bawah "Sumber Daya Manusia"
    protected static ?string $navigationGroup = 'Sumber Daya Manusia';

    // 2. Logika untuk menampilkan menu ini secara dinamis
    public static function canViewAny(): bool
    {
        // Menu ini hanya akan tampil jika tenant yang aktif
        // memiliki akses ke modul 'Penilaian KPI Tahunan'.
        return Tenant::current()?->hasModule('Penilaian KPI Tahunan') ?? false;
    }

    public static function form(Form $form): Form
    {
        // Form definition (akan kita isi nanti saat membangun modul ini)
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        // Table definition (akan kita isi nanti saat membangun modul ini)
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPenilaianKpiTahunans::route('/'),
            'create' => Pages\CreatePenilaianKpiTahunan::route('/create'),
            'edit' => Pages\EditPenilaianKpiTahunan::route('/{record}/edit'),
        ];
    }
}
