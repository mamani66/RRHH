<?php
namespace App\Filament\Resources;

use App\Filament\Resources\ReclutamientosResource\Pages;
use App\Filament\Resources\ReclutamientosResource\RelationManagers;
use App\Models\Reclutamientos;
use App\Models\Empleado;  // Importa el modelo Empleado
use App\Models\Cargo;     // Importa el modelo Cargo
use App\Models\Cargos;
use App\Models\Empleados;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReclutamientosResource extends Resource
{
    protected static ?string $model = Reclutamientos::class;
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
                Forms\Components\Select::make('cargo_id')
                    ->label('Cargo')
                    ->options(Cargos::all()->pluck('nombre', 'id'))
                    ->searchable()
                    ->required(),
                Forms\Components\DatePicker::make('fecha_postulacion')
                    ->required(),
                Forms\Components\Select::make('estado')
                    ->label('Estado')
                    ->options([
                        'pendiente' => 'Pendiente',
                        'en_proceso' => 'En Proceso',
                        'completado' => 'Completado',
                        'rechazado' => 'Rechazado',
                        'aceptado'  => 'Aceptado'
                    ])
                    ->required()
                    ->default('pendiente'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('empleado.nombre')
                    ->label('Empleado')
                    ->sortable(),
                Tables\Columns\TextColumn::make('cargo.nombre')
                    ->label('Cargo')
                    ->sortable(),
                Tables\Columns\TextColumn::make('fecha_postulacion')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('estado')
                    ->searchable(),
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
                // Aquí puedes añadir filtros personalizados si es necesario
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
            // Define any relations if needed
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReclutamientos::route('/'),
            'create' => Pages\CreateReclutamientos::route('/create'),
            'edit' => Pages\EditReclutamientos::route('/{record}/edit'),
        ];
    }
}
