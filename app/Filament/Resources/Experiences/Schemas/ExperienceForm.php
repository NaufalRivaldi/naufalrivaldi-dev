<?php

namespace App\Filament\Resources\Experiences\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ExperienceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Experience Details')
                    ->columns(['default' => 1, 'sm' => 2])
                    ->schema([
                        TextInput::make('role')
                            ->required(),
                        TextInput::make('company')
                            ->required(),
                        TextInput::make('location')
                            ->required(),
                        TextInput::make('duration')
                            ->required(),
                    ])
                    ->columnSpanFull(),

                Section::make('Order & Reference')
                    ->columns(['default' => 1, 'sm' => 2])
                    ->schema([
                        TextInput::make('idx')
                            ->label('Index')
                            ->required(),
                        TextInput::make('sort_order')
                            ->label('Sort Order')
                            ->required()
                            ->numeric()
                            ->default(0),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
