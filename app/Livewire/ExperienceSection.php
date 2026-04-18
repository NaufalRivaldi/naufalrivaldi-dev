<?php

namespace App\Livewire;

use Livewire\Component;

class ExperienceSection extends Component
{
    /**
     * @var array<int, array{idx: string, role: string, company: string, location: string, duration: string}>
     */
    public array $experience = [
        ['idx' => '01', 'role' => 'Senior Backend Developer', 'company' => 'Singapore-based Tech Co.', 'location' => 'Remote · Singapore', 'duration' => '2 Years'],
        ['idx' => '02', 'role' => 'Fullstack Laravel Developer', 'company' => 'Regional SaaS Platform', 'location' => 'Jakarta · Indonesia', 'duration' => '2 Years'],
        ['idx' => '03', 'role' => 'Backend Engineer', 'company' => 'Internal Tools Studio', 'location' => 'Remote', 'duration' => '1 Year'],
        ['idx' => '04', 'role' => 'Junior PHP Developer', 'company' => 'Digital Agency', 'location' => 'Indonesia', 'duration' => '1.5 Years'],
    ];

    public function render(): \Illuminate\View\View
    {
        return view('livewire.experience-section');
    }
}
