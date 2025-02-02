<?php

namespace App\Filament\Resources\PropietariosResource\Pages;

use App\Filament\Resources\PropietariosResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPropietarios extends EditRecord
{
    protected static string $resource = PropietariosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
