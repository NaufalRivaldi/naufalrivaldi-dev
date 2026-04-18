<?php

namespace App\Livewire;

use Livewire\Component;

class TechStackSection extends Component
{
    /**
     * @var array<int, array{name: string, tag: string, level: int, primary: bool}>
     */
    public array $stackItems = [
        ['name' => 'Laravel',    'tag' => 'PHP Framework',  'level' => 95, 'primary' => true],
        ['name' => 'Filament',   'tag' => 'Admin Panel',    'level' => 92, 'primary' => true],
        ['name' => 'Livewire',   'tag' => 'Reactive UI',    'level' => 90, 'primary' => true],
        ['name' => 'Tailwind',   'tag' => 'Styling',        'level' => 88, 'primary' => false],
        ['name' => 'PostgreSQL', 'tag' => 'Database',       'level' => 85, 'primary' => false],
        ['name' => 'Native PHP', 'tag' => 'Core Language',  'level' => 90, 'primary' => false],
        ['name' => 'Next.js',    'tag' => 'Frontend',       'level' => 80, 'primary' => false],
        ['name' => 'Vue.js',     'tag' => 'Frontend',       'level' => 78, 'primary' => false],
    ];

    public function render(): \Illuminate\View\View
    {
        return view('livewire.tech-stack-section');
    }
}
