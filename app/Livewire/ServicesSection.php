<?php

namespace App\Livewire;

use App\Models\Service;
use Illuminate\View\View;
use Livewire\Component;

class ServicesSection extends Component
{
    public function render(): View
    {
        $services = Service::orderBy('sort_order')->get();

        return view('livewire.services-section', compact('services'));
    }
}
