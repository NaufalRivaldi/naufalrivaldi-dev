<?php

namespace App\Livewire;

use Livewire\Component;

class ServicesSection extends Component
{
    /**
     * @var array<int, array{n: string, title: string, icon: string, desc: string, featured: bool}>
     */
    public array $services = [
        ['n' => '01', 'title' => 'Web App Development', 'icon' => 'code', 'featured' => true,
            'desc' => 'End-to-end Laravel + Livewire/Filament web apps with clean architecture and reactive UIs — no page reloads, no compromises.'],
        ['n' => '02', 'title' => 'Backend & APIs', 'icon' => 'server', 'featured' => false,
            'desc' => 'Robust REST & resource APIs, queue workers, background jobs, and auth flows built to scale with real production traffic.'],
        ['n' => '03', 'title' => 'Mobile Development', 'icon' => 'phone', 'featured' => false,
            'desc' => 'Cross-platform companion apps backed by PHP APIs — shipping the same business logic to web and mobile cleanly.'],
        ['n' => '04', 'title' => 'Database Design', 'icon' => 'db', 'featured' => false,
            'desc' => 'PostgreSQL schemas with proper normalization, indexes, and migrations — designed to query fast and stay maintainable.'],
    ];

    public function render(): \Illuminate\View\View
    {
        return view('livewire.services-section');
    }
}
