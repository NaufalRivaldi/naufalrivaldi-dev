<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->rename('contact.contact_email', 'general.contact_email');
        $this->migrator->rename('contact.linkedin_url', 'general.linkedin_url');
        $this->migrator->rename('contact.github_url', 'general.github_url');
        $this->migrator->rename('contact.twitter_url', 'general.twitter_url');
        $this->migrator->rename('contact.availability_status', 'general.availability_status');
        $this->migrator->rename('contact.timezone', 'general.timezone');
    }
};
