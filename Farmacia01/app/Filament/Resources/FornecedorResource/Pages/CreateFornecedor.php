<?php

namespace App\Filament\Resources\FornecedorResource\Pages;

use App\Filament\Resources\FornecedorResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFornecedor extends CreateRecord
{
    protected static string $resource = FornecedorResource::class;
    protected function beforeCreate(): void
    {
        $data = $this->data;
    
            if (empty($data['nome'])) {
                Notification::make()
                    ->title('Nome obrigatório')
                    ->body('Informe o nome do Fornecedor.')
                    ->danger()
                    ->send();
    
                $this->halt();
            }
    }
}
