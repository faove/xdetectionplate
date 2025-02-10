<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PropietariosResource\Pages;
use App\Filament\Resources\PropietariosResource\RelationManagers;
use App\Models\Propietarios;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PropietariosResource extends Resource
{
    protected static ?string $model = Propietarios::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('dominio')
                    ->required()
                    ->maxLength(9),
                Forms\Components\TextInput::make('email')
                    ->required(),
                Forms\Components\TextInput::make('name'),
                Forms\Components\TextInput::make('phone'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('dominio')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('phone'),
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
            'index' => Pages\ListPropietarios::route('/'),
            'create' => Pages\CreatePropietarios::route('/create'),
            'edit' => Pages\EditPropietarios::route('/{record}/edit'),
        ];
    }
}
