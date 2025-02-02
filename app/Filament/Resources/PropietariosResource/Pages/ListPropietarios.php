<?php

namespace App\Filament\Resources\PropietariosResource\Pages;

use App\Filament\Resources\PropietariosResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPropietarios extends ListRecords
{
    protected static string $resource = PropietariosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
