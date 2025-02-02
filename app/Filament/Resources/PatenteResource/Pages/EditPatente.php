<?php

namespace App\Filament\Resources\PatenteResource\Pages;

use App\Filament\Resources\PatenteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPatente extends EditRecord
{
    protected static string $resource = PatenteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
