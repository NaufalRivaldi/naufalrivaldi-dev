<?php

namespace App\Livewire;

use App\Settings\GeneralSettings;
use Illuminate\View\View;
use Livewire\Component;

class ContactSection extends Component
{
    public function render(): View
    {
        $settings = app(GeneralSettings::class);

        return view('livewire.contact-section', ['settings' => $settings]);
    }
}
