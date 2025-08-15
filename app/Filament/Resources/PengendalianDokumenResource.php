<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengendalianDokumenResource\Pages;
use App\Filament\Resources\PengendalianDokumenResource\RelationManagers;
use App\Models\PengendalianDokumen; // Pastikan Anda sudah membuat model ini
use App\Models\Tenant; // Pastikan ini di-import
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PengendalianDokumenResource extends Resource
{
    protected static ?string $model = PengendalianDokumen::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-duplicate';

    // --- LOGIKA NAVIGASI ---

    // 1. Mengelompokkan menu ini di bawah "Manajemen Mutu & Akreditasi"
    protected static ?string $navigationGroup = 'Manajemen Mutu & Akreditasi';

    // 2. Logika untuk menampilkan menu ini secara dinamis
    public static function canViewAny(): bool
    {
        // Menu ini hanya akan tampil jika tenant yang aktif
        // memiliki akses ke modul 'Pengendalian Dokumen ISO'.
        return Tenant::current()?->hasModule('Pengendalian Dokumen ISO') ?? false;
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
            'index' => Pages\ListPengendalianDokumens::route('/'),
            'create' => Pages\CreatePengendalianDokumen::route('/create'),
            'edit' => Pages\EditPengendalianDokumen::route('/{record}/edit'),
        ];
    }
}
