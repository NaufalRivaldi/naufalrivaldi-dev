<?php

namespace App\Livewire;

use App\Models\Project;
use Illuminate\View\View;
use Livewire\Component;

class ProjectsSection extends Component
{
    public function render(): View
    {
        $projects = Project::with('media')->orderBy('sort_order')->get()
            ->map(fn ($p) => [
                'id' => $p->id,
                'slug' => $p->slug,
                'title' => $p->title,
                'subtitle' => $p->subtitle,
                'tag' => $p->tag,
                'tech' => $p->tech,
                'featured' => $p->featured,
                'year' => $p->year,
                'main_image_url' => $p->getFirstMediaUrl('main_image'),
            ])
            ->all();

        $allTechs = Project::all()
            ->flatMap(fn ($p) => $p->tech)
            ->unique()
            ->values()
            ->all();

        return view('livewire.projects-section', compact('projects', 'allTechs'));
    }
}
