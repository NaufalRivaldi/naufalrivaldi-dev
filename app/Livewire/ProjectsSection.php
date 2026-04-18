<?php

namespace App\Livewire;

use Livewire\Component;

class ProjectsSection extends Component
{
    /** @var list<string> */
    public array $allTechs = ['Laravel', 'Filament', 'Livewire', 'Tailwind', 'PostgreSQL', 'Native PHP', 'Next.js', 'Vue.js'];

    /**
     * @var array<int, array{id: int, title: string, tag: string, desc: string, tech: list<string>, featured: bool, year: string}>
     */
    public array $projects = [
        ['id' => 1, 'title' => 'Fintech Admin Panel', 'tag' => 'Fintech', 'featured' => true, 'year' => '2025',
            'desc' => 'Filament-powered admin dashboard for a Singapore payments platform. Role-based permissions, reconciliation, KYC workflows.',
            'tech' => ['Laravel', 'Filament', 'PostgreSQL']],
        ['id' => 2, 'title' => 'Livewire Booking System', 'tag' => 'SaaS', 'featured' => false, 'year' => '2025',
            'desc' => 'Real-time reservation flow with Livewire components — no SPA complexity, fully reactive, shipped in 6 weeks.',
            'tech' => ['Laravel', 'Livewire', 'Tailwind']],
        ['id' => 3, 'title' => 'E-commerce Headless API', 'tag' => 'E-commerce', 'featured' => false, 'year' => '2024',
            'desc' => 'REST API powering a Next.js storefront — catalog, cart, checkout, with queued webhook processors.',
            'tech' => ['Laravel', 'Next.js', 'PostgreSQL']],
        ['id' => 4, 'title' => 'Learning Management System', 'tag' => 'EdTech', 'featured' => false, 'year' => '2024',
            'desc' => 'Multi-tenant LMS for regional schools. Built with Livewire and Filament — grade tracking, attendance, parent portal.',
            'tech' => ['Laravel', 'Livewire', 'Filament']],
        ['id' => 5, 'title' => 'Inventory Microservice', 'tag' => 'Backend', 'featured' => false, 'year' => '2024',
            'desc' => 'Native PHP service handling high-throughput SKU syncs across regional warehouses. Zero downtime migrations.',
            'tech' => ['Native PHP', 'PostgreSQL']],
        ['id' => 6, 'title' => 'Marketing Site + CMS', 'tag' => 'Web', 'featured' => false, 'year' => '2023',
            'desc' => 'Headless Filament CMS powering a Next.js marketing site. Editors ship content without touching code.',
            'tech' => ['Filament', 'Next.js', 'Tailwind']],
        ['id' => 7, 'title' => 'Internal HR Portal', 'tag' => 'Internal Tools', 'featured' => false, 'year' => '2023',
            'desc' => 'Payroll, leave, and performance review workflows for a 200-person company. Replaced five legacy spreadsheets.',
            'tech' => ['Laravel', 'Livewire', 'PostgreSQL']],
        ['id' => 8, 'title' => 'Delivery Tracking App', 'tag' => 'Logistics', 'featured' => false, 'year' => '2023',
            'desc' => 'Driver-facing mobile app with a Laravel API backend — live GPS, proof-of-delivery capture, dispatcher dashboard.',
            'tech' => ['Laravel', 'PostgreSQL', 'Tailwind']],
    ];

    public function render(): \Illuminate\View\View
    {
        return view('livewire.projects-section');
    }
}
