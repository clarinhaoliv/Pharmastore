<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MedicamentoResource\Pages;
use App\Filament\Resources\MedicamentoResource\RelationManagers;
use App\Models\Medicamento;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MedicamentoResource extends Resource
{
    protected static ?string $model = Medicamento::class;

    protected static ?string $navigationIcon = 'heroicon-o-heart';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id_produto')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('lote_fabricacao')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('data_validade')
                    ->required(),
                Forms\Components\TextInput::make('principio_ativo')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('medicamento_controlado')
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
                Tables\Columns\TextColumn::make('lote_fabricacao')
                    ->searchable(),
                Tables\Columns\TextColumn::make('data_validade')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('principio_ativo')
                    ->searchable(),
                    Tables\Columns\TextColumn::make('medicamento_controlado')
                    ->label('Controlado?')
                    ->formatStateUsing(fn (bool $state): string => $state ? 'Não' : 'Sim')
                    ->badge()
                    ->color(fn (bool $state): string => $state ? 'danger' : 'success'),
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
            'index' => Pages\ListMedicamento::route('/'),
            'create' => Pages\CreateMedicamento::route('/create'),
            'edit' => Pages\EditMedicamento::route('/{record}/edit'),
        ];
    }
}
