<?php

namespace App\Filament\Resources\PengendalianDokumenResource\Pages;

use App\Filament\Resources\PengendalianDokumenResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPengendalianDokumens extends ListRecords
{
    protected static string $resource = PengendalianDokumenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
