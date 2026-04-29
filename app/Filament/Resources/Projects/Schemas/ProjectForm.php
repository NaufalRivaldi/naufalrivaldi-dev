<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),
                TextInput::make('title')
                    ->required(),
                TextInput::make('tag')
                    ->label('Category Badge')
                    ->required(),
                Textarea::make('desc')
                    ->label('Description')
                    ->rows(3)
                    ->required()
                    ->columnSpanFull(),
                TagsInput::make('tech')
                    ->label('Tech Stack')
                    ->suggestions(['Laravel', 'Filament', 'Livewire', 'Tailwind', 'PostgreSQL', 'Native PHP', 'Next.js', 'Vue.js'])
                    ->required(),
                TextInput::make('year')
                    ->maxLength(4)
                    ->required(),
                Toggle::make('featured'),
                TextInput::make('sort_order')
                    ->numeric()
                    ->default(0),
                TextInput::make('thumbnail_url')
                    ->label('Thumbnail URL (Cloudinary)')
                    ->url()
                    ->nullable()
                    ->columnSpanFull(),
            ]);
    }
}
