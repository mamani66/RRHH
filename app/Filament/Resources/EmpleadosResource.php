<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmpleadosResource\Pages;
use App\Filament\Resources\EmpleadosResource\RelationManagers;
use App\Models\Empleados;
use App\Models\Departamentos;
use App\Models\Cargos;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EmpleadosResource extends Resource
{
    protected static ?string $model = Empleados::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('apellidos')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('documento')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('fecha_nacimiento')
                    ->required(),
                Forms\Components\TextInput::make('telefono')
                    ->tel()
                    ->maxLength(255)
                    ->nullable(),
                Forms\Components\TextInput::make('estado_civil')
                    ->maxLength(255)
                    ->nullable(),
                Forms\Components\TextInput::make('direccion')
                    ->maxLength(255)
                    ->nullable(),
                Forms\Components\TextInput::make('ciudad')
                    ->maxLength(255)
                    ->nullable(),
                Forms\Components\DateTimePicker::make('fecha_registro'),
                Forms\Components\Select::make('departamento_id')
                    ->label('Departamento')
                    ->options(Departamentos::all()->pluck('nombre', 'id'))
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make('cargo_id')
                    ->label('Cargo')
                    ->options(Cargos::all()->pluck('nombre', 'id'))
                    ->searchable()
                    ->required(),
                Forms\Components\FileUpload::make('foto')
                    ->image()
                    ->directory('uploads/empleados')
                    ->maxSize(1024)
                    ->visibility('public')
                    ->disk('public')
                    ->imagePreviewHeight('100')
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('apellidos')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('documento')
                    ->searchable(),
                Tables\Columns\TextColumn::make('fecha_nacimiento')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('telefono')
                    ->searchable(),
                Tables\Columns\TextColumn::make('estado_civil')
                    ->searchable(),
                Tables\Columns\TextColumn::make('direccion')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ciudad')
                    ->searchable(),
                Tables\Columns\TextColumn::make('departamento.nombre')
                    ->label('Departamento')
                    ->sortable(),
                Tables\Columns\TextColumn::make('cargo.nombre')
                    ->label('Cargo')
                    ->sortable(),
                Tables\Columns\TextColumn::make('fecha_registro')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('foto')
                    ->label('Foto')
                    ->disk('public')
                    ->url(fn ($record) => asset("storage/".$record->foto))
                    ->rounded(),
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
            'index' => Pages\ListEmpleados::route('/'),
            'create' => Pages\CreateEmpleados::route('/create'),
            'edit' => Pages\EditEmpleados::route('/{record}/edit'),
        ];
    }
}
