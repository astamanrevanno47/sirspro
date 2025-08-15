<?php

namespace App\Filament\Resources\PengendalianDokumenResource\Pages;

use App\Filament\Resources\PengendalianDokumenResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPengendalianDokumen extends EditRecord
{
    protected static string $resource = PengendalianDokumenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
