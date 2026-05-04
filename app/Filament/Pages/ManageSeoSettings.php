<?php

namespace App\Filament\Pages;

use App\Settings\SeoSettings;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

/**
 * @property-read Schema $form
 */
class ManageSeoSettings extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMagnifyingGlass;

    protected static ?string $navigationLabel = 'SEO Settings';

    protected static string|UnitEnum|null $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 99;

    protected static ?string $title = 'SEO Settings';

    protected string $view = 'filament.pages.manage-seo-settings';

    /** @var array<string, mixed> */
    public ?array $data = [];

    public function mount(): void
    {
        $settings = app(SeoSettings::class);

        $this->form->fill([
            'site_name' => $settings->site_name,
            'default_title' => $settings->default_title,
            'default_description' => $settings->default_description,
            'default_og_image_url' => $settings->default_og_image_url,
            'twitter_handle' => $settings->twitter_handle,
            'twitter_card_type' => $settings->twitter_card_type,
            'google_site_verification' => $settings->google_site_verification,
            'robots_txt' => $settings->robots_txt,
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Form::make([
                    Section::make('Global Defaults')
                        ->schema([
                            TextInput::make('site_name')
                                ->label('Site Name')
                                ->required()
                                ->columnSpanFull(),
                            TextInput::make('default_title')
                                ->label('Default Page Title')
                                ->required()
                                ->columnSpanFull(),
                            Textarea::make('default_description')
                                ->label('Default Meta Description')
                                ->rows(3)
                                ->columnSpanFull(),
                            TextInput::make('default_og_image_url')
                                ->label('Default OG Image URL')
                                ->url()
                                ->columnSpanFull(),
                        ])
                        ->columns(1)
                        ->columnSpanFull(),

                    Section::make('Social Media')
                        ->schema([
                            TextInput::make('twitter_handle')
                                ->label('Twitter / X Handle')
                                ->prefix('@'),
                            Select::make('twitter_card_type')
                                ->label('Twitter Card Type')
                                ->options([
                                    'summary' => 'Summary',
                                    'summary_large_image' => 'Summary Large Image',
                                ])
                                ->required(),
                        ])
                        ->columns(2)
                        ->columnSpanFull(),

                    Section::make('Verification')
                        ->schema([
                            TextInput::make('google_site_verification')
                                ->label('Google Site Verification Code')
                                ->columnSpanFull(),
                        ])
                        ->columnSpanFull(),

                    Section::make('robots.txt Content')
                        ->schema([
                            Textarea::make('robots_txt')
                                ->label('')
                                ->rows(8)
                                ->columnSpanFull(),
                        ])
                        ->columnSpanFull(),
                ])
                    ->livewireSubmitHandler('save')
                    ->footer([
                        Actions::make([
                            Action::make('save')
                                ->submit('save')
                                ->keyBindings(['mod+s']),
                        ]),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $settings = app(SeoSettings::class);
        $settings->site_name = $data['site_name'];
        $settings->default_title = $data['default_title'];
        $settings->default_description = $data['default_description'] ?? '';
        $settings->default_og_image_url = $data['default_og_image_url'] ?? '';
        $settings->twitter_handle = $data['twitter_handle'] ?? '';
        $settings->twitter_card_type = $data['twitter_card_type'];
        $settings->google_site_verification = $data['google_site_verification'] ?? '';
        $settings->robots_txt = $data['robots_txt'] ?? '';
        $settings->save();

        Notification::make()
            ->success()
            ->title('SEO settings saved')
            ->send();
    }
}
