<?php

namespace App\Filament\Pages;

use App\Settings\GeneralSettings;
use BackedEnum;
use Filament\Actions\Action;
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
class ManageGeneralSettings extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static ?string $navigationLabel = 'General Settings';

    protected static string|UnitEnum|null $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 99;

    protected static ?string $title = 'General Settings';

    protected string $view = 'filament.pages.manage-general-settings';

    /** @var array<string, mixed> */
    public ?array $data = [];

    public function mount(): void
    {
        $settings = app(GeneralSettings::class);

        $this->form->fill([
            'contact_email' => $settings->contact_email,
            'linkedin_url' => $settings->linkedin_url,
            'github_url' => $settings->github_url,
            'twitter_url' => $settings->twitter_url,
            'availability_status' => $settings->availability_status,
            'timezone' => $settings->timezone,
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Form::make([
                    Section::make('Contact Information')
                        ->schema([
                            TextInput::make('contact_email')
                                ->label('Contact Email')
                                ->email()
                                ->required()
                                ->columnSpanFull(),
                        ])
                        ->columnSpanFull(),

                    Section::make('Social Media')
                        ->columns(2)
                        ->schema([
                            TextInput::make('linkedin_url')
                                ->label('LinkedIn URL')
                                ->url()
                                ->placeholder('https://www.linkedin.com/in/your-profile'),
                            TextInput::make('github_url')
                                ->label('GitHub URL')
                                ->url()
                                ->placeholder('https://github.com/your-username'),
                            TextInput::make('twitter_url')
                                ->label('Twitter / X URL')
                                ->url()
                                ->placeholder('https://twitter.com/your-handle'),
                        ])
                        ->columnSpanFull(),

                    Section::make('Availability')
                        ->columns(2)
                        ->schema([
                            TextInput::make('availability_status')
                                ->label('Availability Status')
                                ->placeholder('e.g. Open — Q3 2026'),
                            TextInput::make('timezone')
                                ->label('Timezone Display')
                                ->placeholder('e.g. Asia/Jakarta (UTC+7)'),
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

        $settings = app(GeneralSettings::class);
        $settings->contact_email = $data['contact_email'];
        $settings->linkedin_url = $data['linkedin_url'] ?? '';
        $settings->github_url = $data['github_url'] ?? '';
        $settings->twitter_url = $data['twitter_url'] ?? '';
        $settings->availability_status = $data['availability_status'] ?? '';
        $settings->timezone = $data['timezone'] ?? '';
        $settings->save();

        Notification::make()
            ->success()
            ->title('General settings saved')
            ->send();
    }
}
