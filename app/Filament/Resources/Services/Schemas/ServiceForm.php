<?php

namespace App\Filament\Resources\Services\Schemas;

use App\Enums\ServiceIcon;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make()
                    ->tabs([
                        Tab::make('Content')
                            ->schema([
                                Section::make('Basic Information')
                                    ->columns(['default' => 1, 'sm' => 2])
                                    ->schema([
                                        TextInput::make('slug')
                                            ->required()
                                            ->unique(ignoreRecord: true),
                                        TextInput::make('title')
                                            ->required(),
                                        TextInput::make('subtitle')
                                            ->required()
                                            ->columnSpanFull(),
                                    ])
                                    ->columnSpanFull(),

                                Section::make('Service Details')
                                    ->columns(['default' => 1, 'sm' => 2, 'lg' => 3])
                                    ->schema([
                                        Select::make('icon')
                                            ->options(ServiceIcon::options())
                                            ->required(),
                                        TextInput::make('best_for')
                                            ->label('Best For')
                                            ->required(),
                                        TextInput::make('engagement_duration')
                                            ->label('Engagement Duration')
                                            ->placeholder('e.g. 6–24 weeks')
                                            ->required(),
                                    ])
                                    ->columnSpanFull(),

                                Section::make('Content')
                                    ->schema([
                                        Textarea::make('overview')
                                            ->rows(4)
                                            ->required(),
                                        TagsInput::make('deliverables')
                                            ->label('What You Get')
                                            ->suggestions([
                                                'CI/CD pipeline',
                                                'Handover docs',
                                                '30 days post-launch support',
                                                'OpenAPI schema',
                                                'Load test report',
                                            ])
                                            ->required(),
                                    ])
                                    ->columnSpanFull(),

                                Section::make('Process Steps')
                                    ->schema([
                                        Repeater::make('process')
                                            ->schema([
                                                TextInput::make('title')
                                                    ->required()
                                                    ->columnSpanFull(),
                                                Textarea::make('description')
                                                    ->rows(3)
                                                    ->required()
                                                    ->columnSpanFull(),
                                            ])
                                            ->required(),
                                    ])
                                    ->collapsible()
                                    ->columnSpanFull(),

                                Section::make('Tech Stack & Publishing')
                                    ->columns(['default' => 1, 'sm' => 2])
                                    ->schema([
                                        TagsInput::make('tech_stack')
                                            ->label('Tech Stack')
                                            ->suggestions(['Laravel', 'Filament', 'Livewire', 'Tailwind', 'PostgreSQL', 'Native PHP', 'Next.js', 'Redis', 'REST APIs'])
                                            ->required()
                                            ->columnSpanFull(),
                                        Toggle::make('is_featured'),
                                        TextInput::make('sort_order')
                                            ->numeric()
                                            ->default(0),
                                    ])
                                    ->columnSpanFull(),
                            ]),

                        Tab::make('SEO')
                            ->schema([
                                Section::make()
                                    ->description('Override the default SEO meta for this service page. Leave blank to auto-generate from the service content.')
                                    ->schema([
                                        TextInput::make('seo_title')
                                            ->label('SEO Title')
                                            ->placeholder('e.g. Laravel Development Services — Naufal Rivaldi')
                                            ->maxLength(70)
                                            ->columnSpanFull(),
                                        Textarea::make('seo_description')
                                            ->label('Meta Description')
                                            ->placeholder('150–160 character summary used in search results.')
                                            ->rows(3)
                                            ->maxLength(160)
                                            ->columnSpanFull(),
                                        TextInput::make('seo_og_image_url')
                                            ->label('OG Image URL')
                                            ->url()
                                            ->placeholder('https://cdn.example.com/og/service.jpg')
                                            ->columnSpanFull(),
                                        TextInput::make('seo_robots')
                                            ->label('Robots')
                                            ->default('index, follow')
                                            ->placeholder('index, follow')
                                            ->columnSpanFull(),
                                    ])
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
