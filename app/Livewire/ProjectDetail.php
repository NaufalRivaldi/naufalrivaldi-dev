<?php

namespace App\Livewire;

use App\Models\Project;
use Illuminate\View\View;
use Livewire\Component;

class ProjectDetail extends Component
{
    public string $slug;

    /** @var array<string, mixed> */
    public array $project = [];

    /** @var array<string, mixed> */
    public array $prev = [];

    /** @var array<string, mixed> */
    public array $next = [];

    public function mount(string $slug): void
    {
        $ordered = Project::with('media')->orderBy('sort_order')->get();
        $idx = $ordered->search(fn ($p) => $p->slug === $slug);

        abort_if($idx === false, 404);

        $count = $ordered->count();
        $this->project = $this->toArray($ordered[$idx]);
        $this->prev = $this->toNavItem($ordered[($idx - 1 + $count) % $count]);
        $this->next = $this->toNavItem($ordered[($idx + 1) % $count]);
    }

    public function render(): View
    {
        return view('livewire.project-detail');
    }

    /** @return array<string, mixed> */
    private function toArray(Project $project): array
    {
        return [
            'slug' => $project->slug,
            'title' => $project->title,
            'subtitle' => $project->subtitle,
            'tag' => $project->tag,
            'year' => $project->year,
            'featured' => $project->featured,
            'client' => $project->client,
            'role' => $project->role,
            'duration' => $project->duration,
            'challenge' => $project->challenge,
            'solution' => $project->solution,
            'outcome' => $project->outcome ?? [],
            'tech' => $project->tech,
            'main_image_url' => $project->getFirstMediaUrl('main_image'),
            'gallery_urls' => $project->getMedia('gallery')->map(fn ($m) => $m->getUrl())->toArray(),
        ];
    }

    /** @return array<string, mixed> */
    private function toNavItem(Project $project): array
    {
        return [
            'slug' => $project->slug,
            'title' => $project->title,
        ];
    }
}
