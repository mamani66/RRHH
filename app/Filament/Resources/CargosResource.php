<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CargosResource\Pages;
use App\Filament\Resources\CargosResource\RelationManagers;
use App\Models\Cargos;
use App\Models\Departamento; // Asegúrate de importar el modelo Departamento
use App\Models\Departamentos;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CargosResource extends Resource
{
    protected static ?string $model = Cargos::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('descripcion')
                    ->columnSpanFull(),
                Forms\Components\Select::make('departamento_id')
                    ->label('Departamento')
                    ->options(Departamentos::all()->pluck('nombre', 'id')) // Usar el modelo Departamento para obtener los nombres
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('departamento.nombre') // Muestra el nombre en lugar del ID
                    ->label('Departamento')
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
            // Puedes definir relaciones aquí si es necesario
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCargos::route('/'),
            'create' => Pages\CreateCargos::route('/create'),
            'edit' => Pages\EditCargos::route('/{record}/edit'),
        ];
    }
}
