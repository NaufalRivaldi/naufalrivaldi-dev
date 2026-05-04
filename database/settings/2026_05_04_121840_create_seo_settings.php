<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('seo.site_name', 'Naufal Rivaldi');
        $this->migrator->add('seo.default_title', 'Naufal Rivaldi — Fullstack Developer');
        $this->migrator->add('seo.default_description', 'Fullstack Developer specializing in Laravel, Livewire, and Filament. Available for freelance projects.');
        $this->migrator->add('seo.default_og_image_url', '');
        $this->migrator->add('seo.twitter_handle', '');
        $this->migrator->add('seo.twitter_card_type', 'summary_large_image');
        $this->migrator->add('seo.google_site_verification', '');
        $this->migrator->add('seo.robots_txt', "User-agent: *\nAllow: /\n\nSitemap: /sitemap.xml");
    }
};
