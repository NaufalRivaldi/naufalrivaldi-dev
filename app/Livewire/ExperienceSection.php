<?php

namespace App\Livewire;

use App\Models\Experience;
use Illuminate\View\View;
use Livewire\Component;

class ExperienceSection extends Component
{
    public function render(): View
    {
        $experience = Experience::orderBy('sort_order')->get()
            ->map(fn ($e) => [
                'idx' => $e->idx,
                'role' => $e->role,
                'company' => $e->company,
                'location' => $e->location,
                'duration' => $e->duration,
            ])
            ->all();

        return view('livewire.experience-section', compact('experience'));
    }
}
