<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class ProjectForm
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
                                            ->label('Subtitle / Tagline')
                                            ->required()
                                            ->columnSpanFull(),
                                        TextInput::make('tag')
                                            ->label('Category Badge')
                                            ->required(),
                                        TextInput::make('year')
                                            ->maxLength(4)
                                            ->required(),
                                        Toggle::make('featured'),
                                        TextInput::make('sort_order')
                                            ->numeric()
                                            ->default(0),
                                    ])
                                    ->columnSpanFull(),

                                Section::make('Project Meta')
                                    ->columns(['default' => 1, 'sm' => 3])
                                    ->schema([
                                        TextInput::make('client')
                                            ->required(),
                                        TextInput::make('role')
                                            ->label('My Role')
                                            ->required(),
                                        TextInput::make('duration')
                                            ->placeholder('e.g. 8 months')
                                            ->required(),
                                    ])
                                    ->columnSpanFull(),

                                Section::make('Media')
                                    ->schema([
                                        SpatieMediaLibraryFileUpload::make('main_image')
                                            ->label('Main Image')
                                            ->collection('main_image')
                                            ->image()
                                            ->visibility('public')
                                            ->imagePreviewHeight('200')
                                            ->columnSpanFull(),
                                        SpatieMediaLibraryFileUpload::make('gallery')
                                            ->label('Gallery')
                                            ->collection('gallery')
                                            ->multiple()
                                            ->image()
                                            ->visibility('public')
                                            ->imagePreviewHeight('150')
                                            ->reorderable()
                                            ->columnSpanFull(),
                                    ])
                                    ->columnSpanFull(),

                                Section::make('Case Study')
                                    ->schema([
                                        Textarea::make('challenge')
                                            ->rows(4)
                                            ->required()
                                            ->columnSpanFull(),
                                        Textarea::make('solution')
                                            ->rows(4)
                                            ->required()
                                            ->columnSpanFull(),
                                    ])
                                    ->columnSpanFull(),

                                Section::make('Outcome Metrics')
                                    ->schema([
                                        Repeater::make('outcome')
                                            ->schema([
                                                TextInput::make('k')
                                                    ->label('Metric Label')
                                                    ->placeholder('e.g. Reconciliation time')
                                                    ->required(),
                                                TextInput::make('v')
                                                    ->label('Value')
                                                    ->placeholder('e.g. -92%')
                                                    ->required(),
                                            ])
                                            ->columns(2)
                                            ->defaultItems(3)
                                            ->columnSpanFull(),
                                    ])
                                    ->columnSpanFull(),

                                Section::make('Tech Stack')
                                    ->schema([
                                        TagsInput::make('tech')
                                            ->label('Tech Stack')
                                            ->suggestions(['Laravel', 'Filament', 'Livewire', 'Tailwind', 'PostgreSQL', 'Native PHP', 'Next.js', 'Vue.js', 'Redis'])
                                            ->required()
                                            ->columnSpanFull(),
                                    ])
                                    ->columnSpanFull(),
                            ]),

                        Tab::make('SEO')
                            ->schema([
                                Section::make()
                                    ->description('Override the default SEO meta for this project page. OG image falls back to the main project image if blank.')
                                    ->schema([
                                        TextInput::make('seo_title')
                                            ->label('SEO Title')
                                            ->placeholder('e.g. Project Name — Naufal Rivaldi')
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
                                            ->placeholder('Leave blank to use the main project image automatically.')
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
