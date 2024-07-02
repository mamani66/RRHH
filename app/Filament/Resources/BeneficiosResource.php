<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BeneficiosResource\Pages;
use App\Models\Beneficios;
use App\Models\Empleado;
use App\Models\Empleados;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BeneficiosResource extends Resource
{
    protected static ?string $model = Beneficios::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('empleado_id')
                    ->label('Empleado')
                    ->options(Empleados::query()->pluck('nombre', 'id'))
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('tipo')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('descripcion')
                    ->columnSpanFull(),
                Forms\Components\DatePicker::make('fecha_asignacion')
                    ->required(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('empleado.nombre')
                    ->label('Empleado')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('tipo')
                ->searchable(),
                TextColumn::make('fecha_asignacion')
                ->date()
                ->sortable(),
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
                // Puedes agregar filtros aquí si es necesario
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
            'index' => Pages\ListBeneficios::route('/'),
            'create' => Pages\CreateBeneficios::route('/create'),
            'edit' => Pages\EditBeneficios::route('/{record}/edit'),
        ];
    }
}
