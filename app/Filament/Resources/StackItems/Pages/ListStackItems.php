<?php

namespace App\Filament\Resources\StackItems\Pages;

use App\Filament\Resources\StackItems\StackItemResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListStackItems extends ListRecords
{
    protected static string $resource = StackItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
