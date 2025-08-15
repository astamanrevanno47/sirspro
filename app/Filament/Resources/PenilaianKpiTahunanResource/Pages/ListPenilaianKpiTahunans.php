<?php

namespace App\Filament\Resources\PenilaianKpiTahunanResource\Pages;

use App\Filament\Resources\PenilaianKpiTahunanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPenilaianKpiTahunans extends ListRecords
{
    protected static string $resource = PenilaianKpiTahunanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
