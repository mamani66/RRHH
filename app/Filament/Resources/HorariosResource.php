<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HorariosResource\Pages;
use App\Models\Horarios;
use App\Models\Empleado; // Asegúrate de importar el modelo Empleado
use App\Models\Empleados;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HorariosResource extends Resource
{
    protected static ?string $model = Horarios::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\Select::make('empleado_id')
                ->label('Empleado')
                ->options(Empleados::all()->pluck('nombre', 'id')) // Asegúrate de que 'nombre' sea el campo correcto
                ->searchable()
                ->required(),
            Forms\Components\Select::make('dia_semana')
                ->label('Día de la semana')
                ->options([
                    'Lunes' => 'Lunes',
                    'Martes' => 'Martes',
                    'Miércoles' => 'Miércoles',
                    'Jueves' => 'Jueves',
                    'Viernes' => 'Viernes',
                    'Sábado' => 'Sábado',
                    'Domingo' => 'Domingo',
                ])
                ->required(),
            Forms\Components\Select::make('turno')
                ->label('Turno')
                ->options([
                    'Mañana' => 'Mañana',
                    'Tarde' => 'Tarde',
                    'Noche' => 'Noche',
                ])
                ->required(),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            TextColumn::make('empleado.nombre')  // Cambio clave aquí
                ->label('Empleado')
                ->sortable()
                ->searchable(),
            TextColumn::make('dia_semana')
            ->sortable()
            ->searchable(),
            TextColumn::make('turno')
            ->sortable()
            ->searchable(),
            TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('updated_at')
            ->dateTime()
            ->sortable()
            ->toggleable(isToggledHiddenByDefault: true),
        ])
        ->filters([
            // Aquí puedes añadir filtros si necesitas
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
    }

    public static function getRelations(): array
    {
        return [
            // Define aquí las relaciones si son necesarias
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHorarios::route('/'),
            'create' => Pages\CreateHorarios::route('/create'),
            'edit' => Pages\EditHorarios::route('/{record}/edit'),
        ];
    }
}
