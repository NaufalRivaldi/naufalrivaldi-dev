<?php

namespace App\Livewire;

use App\Models\StackItem;
use Illuminate\View\View;
use Livewire\Component;

class TechStackSection extends Component
{
    public function render(): View
    {
        $stackItems = StackItem::orderBy('sort_order')->get()
            ->map(fn ($s) => [
                'name' => $s->name,
                'tag' => $s->tag,
                'level' => $s->level,
                'primary' => $s->primary,
            ])
            ->all();

        return view('livewire.tech-stack-section', compact('stackItems'));
    }
}
