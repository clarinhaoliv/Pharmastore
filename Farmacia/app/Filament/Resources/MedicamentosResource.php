<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MedicamentosResource\Pages;
use App\Filament\Resources\MedicamentosResource\RelationManagers;
use App\Models\Medicamentos;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MedicamentosResource extends Resource
{
    protected static ?string $model = Medicamentos::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id_produto')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('Lote de Fabricação')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('Data de Validade')
                    ->required(),
                Forms\Components\TextInput::make('Princípio Ativo')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('Medicamento Controlado')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_produto')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('Lote de Fabricação')
                    ->searchable(),
                Tables\Columns\TextColumn::make('Data de Validade')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('Princípio Ativo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('Medicamento Controlado'),
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
            'index' => Pages\ListMedicamentos::route('/'),
            'create' => Pages\CreateMedicamentos::route('/create'),
            'edit' => Pages\EditMedicamentos::route('/{record}/edit'),
        ];
    }
}
