<?php

namespace App\Filament\Resources\PerfumariaResource\Pages;

use App\Filament\Resources\PerfumariaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPerfumaria extends EditRecord
{
    protected static string $resource = PerfumariaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
