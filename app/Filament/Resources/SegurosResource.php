<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SegurosResource\Pages;
use App\Filament\Resources\SegurosResource\RelationManagers;
use App\Models\Seguros;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SegurosResource extends Resource
{
    protected static ?string $model = Seguros::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('empleado_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('tipo')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('numero')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('descripcion')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('vigencia')
                    ->required(),
                Forms\Components\TextInput::make('estado')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('valor')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('prima_neta')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('total')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('empleado_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tipo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('numero')
                    ->searchable(),
                Tables\Columns\TextColumn::make('descripcion')
                    ->searchable(),
                Tables\Columns\TextColumn::make('vigencia')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('estado')
                    ->searchable(),
                Tables\Columns\TextColumn::make('valor')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('prima_neta')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListSeguros::route('/'),
            'create' => Pages\CreateSeguros::route('/create'),
            'edit' => Pages\EditSeguros::route('/{record}/edit'),
        ];
    }
}
