<?php

namespace App\Filament\Resources\PatenteResource\Pages;

use App\Filament\Resources\PatenteResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPatentes extends ListRecords
{
    protected static string $resource = PatenteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('UploadPatente') // Botón personalizado "Search Patente"
                ->label('Upload Patente')
                ->color('success') // Color del botón
                ->icon('heroicon-o-magnifying-glass') // Ícono del botón
                ->url(route('filament.admin.resources.patentes.upload'))
                ->tooltip('Cargar imagen de patente'), // Tooltip del botón
        ];
    }
}
