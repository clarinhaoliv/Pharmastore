<?php

namespace App\Filament\Resources\ProdutoResource\Pages;

use App\Filament\Resources\ProdutoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProduto extends CreateRecord
{
    protected static string $resource = ProdutoResource::class;
    protected function beforeCreate(): void
    {
        $data = $this->data;
    
            if (empty($data['nome'])) {
                Notification::make()
                    ->title('Nome obrigatório')
                    ->body('Informe o nome do produto.')
                    ->danger()
                    ->send();
    
                $this->halt();
            }
    
            if (!isset($data['categoria']) || !in_array($data['categoria'], ['medicamento', 'perfumaria'])) {
                Notification::make()
                    ->title('Categoria inválida')
                    ->body('Escolha medicamento ou perfumaria.')
                    ->danger()
                    ->send();
    
                $this->halt();
            }
    
            if (!isset($data['quantidade']) || $data['quantidade'] < 0) {
                Notification::make()
                    ->title('Quantidade inválida')
                    ->body('A quantidade não pode ser negativa.')
                    ->danger()
                    ->send();
    
                $this->halt();
            }
    }
    
    protected function afterCreate(): void
    {
        $produto = $this->record;
    
            if ($produto->quantidade == 0) {
                Notification::make()
                    ->title('Falta no estoque')
                    ->body("O produto '{$produto->nome}' está sem estoque.")
                    ->danger()
                    ->send();
            } elseif ($produto->quantidade < $produto->estoque_minimo) {
                Notification::make()
                    ->title('Estoque baixo')
                    ->body("O produto '{$produto->nome}' está abaixo do mínimo.")
                    ->warning()
                    ->send();
            } else {
                Notification::make()
                    ->title('Produto criado')
                    ->body("O produto '{$produto->nome}' foi cadastrado com sucesso.")
                    ->success()
                    ->send();
            }
    }
}
