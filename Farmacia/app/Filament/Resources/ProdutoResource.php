<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProdutoResource\Pages;
use App\Filament\Resources\ProdutoResource\RelationManagers;
use App\Models\Produto;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProdutoResource extends Resource
{
    protected static ?string $model = Produto::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id_fornecedor')
                    ->relationship('fornecedor', 'nome')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('nome')
                    ->required()
                    ->maxLength(255)
                    ->label('Nome'),

                Forms\Components\TextInput::make('Preço')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('Quantidade')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('estoque_minimo')
                    ->required()
                    ->numeric()
                    ->default(5),
                Forms\Components\Select::make('categoria')
                ->label('Categoria')
                ->options([
                    'medicamento' => 'Medicamento',
                    'perfumaria' => 'Perfumaria',
                ])
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_fornecedor')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('Nome')
                    ->searchable(),
                Tables\Columns\TextColumn::make('Preço')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('Quantidade')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('estoque_minimo')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('Categoria'),
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
            'index' => Pages\ListProdutos::route('/'),
            'create' => Pages\CreateProduto::route('/create'),
            'edit' => Pages\EditProduto::route('/{record}/edit'),
        ];
    }
}
