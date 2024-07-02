<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DocumentosResource\Pages;
use App\Filament\Resources\DocumentosResource\RelationManagers;
use App\Models\Documentos;
use App\Models\Empleados;  // Importar el modelo de Empleados
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DocumentosResource extends Resource
{
    protected static ?string $model = Documentos::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('tipo')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('codigo')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('empleado_id')
                    ->label('Empleado')
                    ->relationship('empleado', 'nombre')  // Asegúrate de tener una relación adecuada en el modelo Empleados
                    ->required(),
                Forms\Components\FileUpload::make('archivo')
                    ->label('Archivo')
                    ->disk('public')  // Asegura que el disco está configurado correctamente en config/filesystems.php
                    ->directory('documentos')  // Define el directorio de almacenamiento
                    ->acceptedFileTypes(['application/pdf', 'image/*', 'text/plain'])  // Tipos de archivos aceptados
                    ->visibility('public')  // Define la visibilidad del archivo
                    ->required(),
                Forms\Components\DatePicker::make('fecha_emision')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tipo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('codigo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('empleado.nombre')
                    ->label('Empleado')
                    ->sortable(),
                Tables\Columns\TextColumn::make('archivo')
                    ->url(fn($record) => asset('storage/' . $record->archivo))  // Genera un enlace directo al archivo almacenado
                    ->label('Archivo')
                    ->sortable(),
                Tables\Columns\TextColumn::make('fecha_emision')
                    ->date()
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
            'index' => Pages\ListDocumentos::route('/'),
            'create' => Pages\CreateDocumentos::route('/create'),
            'edit' => Pages\EditDocumentos::route('/{record}/edit'),
        ];
    }
}
