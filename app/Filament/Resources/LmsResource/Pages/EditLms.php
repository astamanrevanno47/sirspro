<?php

namespace App\Filament\Resources\LmsResource\Pages;

use App\Filament\Resources\LmsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLms extends EditRecord
{
    protected static string $resource = LmsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
