<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KpiResource\Pages;
use App\Filament\Resources\KpiResource\RelationManagers;
use App\Models\Kpi; // Pastikan Anda sudah membuat model ini
use App\Models\Tenant; // Pastikan ini di-import
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KpiResource extends Resource
{
    protected static ?string $model = Kpi::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar-square';

    // --- LOGIKA NAVIGASI ---

    // 1. Mengelompokkan menu ini di bawah "Sumber Daya Manusia"
    protected static ?string $navigationGroup = 'Sumber Daya Manusia';

    // 2. Logika untuk menampilkan menu ini secara dinamis
    public static function canViewAny(): bool
    {
        // Menu ini hanya akan tampil jika tenant yang aktif
        // memiliki akses ke modul 'KPI'.
        return Tenant::current()?->hasModule('KPI') ?? false;
    }

    public static function form(Form $form): Form
    {
        // Form definition (akan kita isi nanti saat membangun modul KPI)
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        // Table definition (akan kita isi nanti saat membangun modul KPI)
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
            'index' => Pages\ListKpis::route('/'),
            'create' => Pages\CreateKpi::route('/create'),
            'edit' => Pages\EditKpi::route('/{record}/edit'),
        ];
    }
}
