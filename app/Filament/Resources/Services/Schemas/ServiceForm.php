<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ServiceForm
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
                TextInput::make('subtitle')
                    ->required()
                    ->columnSpanFull(),
                Select::make('icon')
                    ->options([
                        'code'   => 'Code',
                        'server' => 'Server',
                        'phone'  => 'Phone',
                        'db'     => 'Database',
                    ])
                    ->required(),
                TextInput::make('best_for')
                    ->label('Best For')
                    ->required(),
                TextInput::make('engagement_duration')
                    ->label('Engagement Duration')
                    ->placeholder('e.g. 6–24 weeks')
                    ->required(),
                Textarea::make('overview')
                    ->rows(4)
                    ->required()
                    ->columnSpanFull(),
                TagsInput::make('deliverables')
                    ->label('What You Get')
                    ->suggestions([
                        'CI/CD pipeline',
                        'Handover docs',
                        '30 days post-launch support',
                        'OpenAPI schema',
                        'Load test report',
                    ])
                    ->required()
                    ->columnSpanFull(),
                Repeater::make('process')
                    ->schema([
                        TextInput::make('title')
                            ->required(),
                        Textarea::make('description')
                            ->rows(3)
                            ->required(),
                    ])
                    ->required()
                    ->columnSpanFull(),
                TagsInput::make('tech_stack')
                    ->label('Tech Stack')
                    ->suggestions(['Laravel', 'Filament', 'Livewire', 'Tailwind', 'PostgreSQL', 'Native PHP', 'Next.js', 'Redis', 'REST APIs'])
                    ->required()
                    ->columnSpanFull(),
                Toggle::make('is_featured'),
                TextInput::make('sort_order')
                    ->numeric()
                    ->default(0),
            ]);
    }
}
