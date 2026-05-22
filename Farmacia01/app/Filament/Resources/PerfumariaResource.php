<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PerfumariaResource\Pages;
use App\Filament\Resources\PerfumariaResource\RelationManagers;
use App\Models\Perfumaria;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PerfumariaResource extends Resource
{
    protected static ?string $model = Perfumaria::class;

    protected static ?string $navigationIcon = 'heroicon-o-beaker';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id_produto')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('lote_fabricação')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('data_validade')
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
                Tables\Columns\TextColumn::make('lote_fabricação')
                    ->searchable(),
                Tables\Columns\TextColumn::make('data_validade')
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
            'index' => Pages\ListPerfumarias::route('/'),
            'create' => Pages\CreatePerfumaria::route('/create'),
            'edit' => Pages\EditPerfumaria::route('/{record}/edit'),
        ];
    }
}
