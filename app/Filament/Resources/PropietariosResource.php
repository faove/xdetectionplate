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
use Filament\Tables\Actions\Action;
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
                Forms\Components\TextInput::make('num_ndoc')
                    ->required(),
                Forms\Components\TextInput::make('num_cuit'),
                Forms\Components\TextInput::make('name'),
                Forms\Components\TextInput::make('email')
                    ->required(),
                Forms\Components\TextInput::make('domicilio'),
                Forms\Components\TextInput::make('phone'),
                Forms\Components\TextInput::make('obj_id'),
                Forms\Components\TextInput::make('num'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('num_ndoc')
                    ->searchable(),
                Tables\Columns\TextColumn::make('num_cuit')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('domicilio'),
                Tables\Columns\TextColumn::make('obj_id'),
                Tables\Columns\TextColumn::make('num'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('phone'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('delete')
                    ->requiresConfirmation()
                    ->action(fn (Propietarios $record) => $record->delete())
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
