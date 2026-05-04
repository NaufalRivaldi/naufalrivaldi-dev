<?php

namespace App\Livewire;

use App\Models\Service;
use Illuminate\View\View;
use Livewire\Component;

class ServiceDetail extends Component
{
    public string $slug;

    public Service $service;

    public string $serviceNumber;

    /** @var array{slug: string, title: string} */
    public array $prev = [];

    /** @var array{slug: string, title: string} */
    public array $next = [];

    public function mount(string $slug): void
    {
        $all = Service::orderBy('sort_order')->get();
        $idx = $all->search(fn ($s) => $s->slug === $slug);

        abort_if($idx === false, 404);

        $count = $all->count();
        $this->service = $all[$idx];
        $this->serviceNumber = sprintf('%02d', $idx + 1);

        $prevModel = $all[($idx - 1 + $count) % $count];
        $this->prev = ['slug' => $prevModel->slug, 'title' => $prevModel->title];

        $nextModel = $all[($idx + 1) % $count];
        $this->next = ['slug' => $nextModel->slug, 'title' => $nextModel->title];
    }

    public function render(): View
    {
        return view('livewire.service-detail');
    }
}
