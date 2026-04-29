<?php

namespace App\Filament\Resources\StackItems\Pages;

use App\Filament\Resources\StackItems\StackItemResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditStackItem extends EditRecord
{
    protected static string $resource = StackItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
