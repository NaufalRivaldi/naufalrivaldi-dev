<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('contact.contact_email', 'naufal.rivaldi33@gmail.com');
        $this->migrator->add('contact.linkedin_url', 'https://www.linkedin.com/in/naufal-rivaldi-18b385158/');
        $this->migrator->add('contact.github_url', 'https://github.com/naufal-rivaldi');
        $this->migrator->add('contact.twitter_url', '');
        $this->migrator->add('contact.availability_status', 'Open — Q3 2026');
        $this->migrator->add('contact.timezone', 'Asia/Jakarta (UTC+7)');
    }
};
