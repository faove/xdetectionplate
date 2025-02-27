<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Patente;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use App\Filament\Pages\VerFacilidades;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PatenteResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PatenteResource\RelationManagers;

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
                Action::make('verFacilidades')
                    ->label('Ver Facilidades')
                    ->icon('heroicon-o-eye')
                    ->url(fn (Patente $record): string => VerFacilidades::getUrl(['obj_id' => $record->obj_id])),
                    // ->url(fn (VerFacilidades $record): string => route('pages.ver-facilidades', ['obj_id' => $record->obj_id])),
                Action::make('delete')
                    ->requiresConfirmation()
                    ->action(fn (Patente $record) => $record->delete())
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
            'upload' => Pages\UploadPatente::route('/upload'),
        ];
    }
}
