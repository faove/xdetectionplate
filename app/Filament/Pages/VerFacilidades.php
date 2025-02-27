<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\ViewFacilidaPeriodo;
use Filament\Tables;
use Filament\Tables\Table;


class VerFacilidades extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.ver-facilidades';

    public $obj_id;
    public $facilidades;

    public function mount()
    {
        $this->facilidades = ViewFacilidaPeriodo::where('obj_id', request()->query('obj_id'))->get();
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('anio')->label('Año'),
                Tables\Columns\TextColumn::make('cuota')->label('Cuota'),
                Tables\Columns\TextColumn::make('trib_nom')->label('Tributo'),
                Tables\Columns\TextColumn::make('nominal')->label('Nominal'),
                Tables\Columns\TextColumn::make('accesor')->label('Accesorios'),
                Tables\Columns\TextColumn::make('multa')->label('Multa'),
                Tables\Columns\TextColumn::make('total')->label('Total')->money('ARS'),
                Tables\Columns\TextColumn::make('quita')->label('Quita'),
                Tables\Columns\TextColumn::make('fchvenc')->label('Fecha Vencimiento')->date(),
            ])
            ->records($this->facilidades);
    }
}
