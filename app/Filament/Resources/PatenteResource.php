<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatenteResource\Pages;
use App\Filament\Resources\PatenteResource\RelationManagers;
use App\Models\Patente;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PatenteResource extends Resource
{
    protected static ?string $model = Patente::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('dominio')
                    ->required()
                    ->maxLength(9),
                Forms\Components\DatePicker::make('fchregistro')
                    ->required()
                    ->maxDate(now()),                
                Forms\Components\TextInput::make('marca_name')
                    ->numeric(),
                Forms\Components\TextInput::make('modelo_name')
                    ->numeric(),
                // Campo para subir la imagen
                Forms\Components\FileUpload::make('imagen')
                    ->label('Imagen del vehículo')
                    ->directory('patentes') // Carpeta donde se guardarán las imágenes
                    ->image() // Asegura que solo se suban imágenes
                    ->maxSize(2048) // Tamaño máximo en KB (2MB)
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('dominio')
                    ->searchable(),
                Tables\Columns\TextColumn::make('fchregistro'),
                Tables\Columns\TextColumn::make('marca_name'),
                Tables\Columns\TextColumn::make('modelo_name'),
                // Columna para mostrar la imagen
                Tables\Columns\ImageColumn::make('imagen')
                    ->label('Imagen')
                    ->disk('public'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPatentes::route('/'),
            'create' => Pages\CreatePatente::route('/create'),
            'edit' => Pages\EditPatente::route('/{record}/edit'),
        ];
    }
}
