<?php

namespace App\Filament\Resources\StackItems;

use App\Filament\Resources\StackItems\Pages\CreateStackItem;
use App\Filament\Resources\StackItems\Pages\EditStackItem;
use App\Filament\Resources\StackItems\Pages\ListStackItems;
use App\Filament\Resources\StackItems\Schemas\StackItemForm;
use App\Filament\Resources\StackItems\Tables\StackItemsTable;
use App\Models\StackItem;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class StackItemResource extends Resource
{
    protected static ?string $model = StackItem::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCpuChip;

    protected static ?int $navigationSort = 4;

    protected static string|UnitEnum|null $navigationGroup = 'Management';

    public static function form(Schema $schema): Schema
    {
        return StackItemForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StackItemsTable::configure($table);
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
            'index' => ListStackItems::route('/'),
            'create' => CreateStackItem::route('/create'),
            'edit' => EditStackItem::route('/{record}/edit'),
        ];
    }
}
