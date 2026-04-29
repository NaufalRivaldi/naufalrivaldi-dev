<?php

namespace App\Livewire;

use App\Models\Service;
use Illuminate\View\View;
use Livewire\Component;

class ServicesSection extends Component
{
    public function render(): View
    {
        $services = Service::orderBy('sort_order')->get()
            ->map(fn ($s) => [
                'slug' => $s->slug,
                'n' => $s->number,
                'title' => $s->title,
                'icon' => $s->icon,
                'desc' => $s->desc,
                'featured' => $s->featured,
            ])
            ->all();

        return view('livewire.services-section', compact('services'));
    }
}
