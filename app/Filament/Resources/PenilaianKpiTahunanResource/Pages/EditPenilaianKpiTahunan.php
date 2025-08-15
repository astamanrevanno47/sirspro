<?php

namespace App\Filament\Resources\PenilaianKpiTahunanResource\Pages;

use App\Filament\Resources\PenilaianKpiTahunanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPenilaianKpiTahunan extends EditRecord
{
    protected static string $resource = PenilaianKpiTahunanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
