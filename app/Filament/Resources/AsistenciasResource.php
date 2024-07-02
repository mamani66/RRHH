<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AsistenciasResource\Pages;
use App\Filament\Resources\AsistenciasResource\RelationManagers;
use App\Models\Asistencias;
use App\Models\Empleado; // Asegúrate de importar el modelo Empleado
use App\Models\Empleados;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AsistenciasResource extends Resource
{
    protected static ?string $model = Asistencias::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('empleado_id')
                    ->label('Empleado')
                    ->options(Empleados::all()->pluck('nombre', 'id'))
                    ->searchable()
                    ->required(),
                Forms\Components\DatePicker::make('fecha')
                    ->required(),
                Forms\Components\Toggle::make('asistencia')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('empleado.nombre') // Muestra el nombre del empleado
                    ->label('Empleado')
                    ->sortable(),
                Tables\Columns\TextColumn::make('fecha')
                    ->date()
                    ->sortable(),
                Tables\Columns\IconColumn::make('asistencia')
                    ->boolean(),
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
                // Aquí puedes añadir filtros si lo necesitas
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
            // Define aquí relaciones adicionales si son necesarias
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAsistencias::route('/'),
            'create' => Pages\CreateAsistencias::route('/create'),
            'edit' => Pages\EditAsistencias::route('/{record}/edit'),
        ];
    }
}
