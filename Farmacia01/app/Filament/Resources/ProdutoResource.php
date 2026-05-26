<?php

namespace App\Filament\Resources;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
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
use Filament\Notifications\Notification;

class ProdutoResource extends Resource
{
    protected static ?string $model = Produto::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('fornecedor_id')
                ->label('Fornecedor')
                ->relationship('fornecedor', 'nome')
                ->required()
                ->searchable()
                ->preload(),

        TextInput::make('nome')
            ->label('nome')
            ->required(),

        TextInput::make('preco')
            ->label('preco')
            ->numeric()
            ->required(),

        TextInput::make('quantidade')
            ->label('quantidade')
            ->numeric()
            ->required(),

        TextInput::make('estoque_minimo')
            ->label('estoque_minim')
            ->numeric()
            ->required(),

        Select::make('categoria')
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
            Tables\Columns\TextColumn::make('fornecedor.nome')
                ->label('Fornecedor')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('nome')
                ->label('Nome')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('preco')
                ->label('Preço')
                ->money('BRL')
                ->sortable(),

            Tables\Columns\TextColumn::make('quantidade')
                ->label('Quantidade')
                ->sortable(),

            Tables\Columns\TextColumn::make('estoque_minimo')
                ->label('Estoque Mínimo')
                ->sortable(),

            Tables\Columns\TextColumn::make('categoria')
                ->label('Categoria')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'medicamento' => 'success',
                    'perfumaria'  => 'info',
                })
                ->sortable(),

            Tables\Columns\TextColumn::make('created_at')
                ->label('Criado em')
                ->dateTime('d/m/Y H:i')
                ->sortable()
                ->toggleable(),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('fornecedor_id')
                ->relationship('fornecedor', 'nome')
                ->label('Fornecedor'),

            Tables\Filters\SelectFilter::make('categoria')
                ->options([
                    'medicamento' => 'Medicamento',
                    'perfumaria'  => 'Perfumaria',
                ])
                ->label('Categoria'),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
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
