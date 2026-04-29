<?php

namespace App\Filament\Resources\Experiences\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ExperienceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('idx')
                    ->required(),
                TextInput::make('role')
                    ->required(),
                TextInput::make('company')
                    ->required(),
                TextInput::make('location')
                    ->required(),
                TextInput::make('duration')
                    ->required(),
                TextInput::make('sort_order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
