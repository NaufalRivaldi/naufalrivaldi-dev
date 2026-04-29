<?php

namespace Database\Seeders;

use App\Models\Experience;
use App\Models\Project;
use App\Models\Service;
use App\Models\StackItem;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        Service::create([
            'slug'                => 'web-apps',
            'title'               => 'Web App Development',
            'subtitle'            => 'Production Laravel apps, shipped without drama.',
            'overview'            => 'End-to-end Laravel + Livewire/Filament web apps with clean architecture and reactive UIs — no page reloads, no compromises.',
            'best_for'            => 'Startups needing a full product, or teams replacing a legacy PHP/WordPress monolith.',
            'engagement_duration' => '6–24 weeks',
            'deliverables'        => [
                'Laravel 11+ monolith with domain-driven structure',
                'Filament v3 admin panel, fully policied',
                'Livewire-powered reactive UIs for end users',
                'CI/CD pipeline, staging + production environments',
                'Handover docs + 30 days post-launch support',
            ],
            'process' => [
                ['title' => 'Discovery',        'description' => 'One week of calls + artifact review. I map your domain, surface risks, and propose scope.'],
                ['title' => 'Architecture',      'description' => 'DB schema, API contracts, Filament resources, Livewire component tree — signed off before a line of code.'],
                ['title' => 'Sprint Delivery',   'description' => 'Two-week sprints, demo every Friday, staging always current. You see progress, not promises.'],
                ['title' => 'Launch + Handover', 'description' => 'Production deploy, docs, and 30 days of hands-on support for whoever takes over.'],
            ],
            'tech_stack'  => ['Laravel', 'Filament', 'Livewire', 'Tailwind', 'PostgreSQL'],
            'icon'        => 'code',
            'is_featured' => true,
            'sort_order'  => 1,
        ]);

        Service::create([
            'slug'                => 'backend-apis',
            'title'               => 'Backend & APIs',
            'subtitle'            => 'The parts nobody sees — but everyone depends on.',
            'overview'            => 'Robust REST & resource APIs, queue workers, background jobs, and auth flows built to scale with real production traffic.',
            'best_for'            => 'Teams with a frontend (web or mobile) needing a serious backend, or consolidating microservices.',
            'engagement_duration' => '4–12 weeks',
            'deliverables'        => [
                'REST API with OpenAPI schema + typed SDK',
                'Queued jobs via Horizon, with retry/backoff policies',
                'Authentication: Sanctum, OAuth2, or SSO as needed',
                'Rate limiting, idempotency keys, audit log',
                'Load test report + scaling plan',
            ],
            'process' => [
                ['title' => 'Contract First',  'description' => 'We design the API surface before implementation. Frontend can mock immediately.'],
                ['title' => 'Implementation',  'description' => 'Laravel controllers, resources, policies. Tests on every endpoint.'],
                ['title' => 'Hardening',       'description' => 'Rate limits, idempotency, observability, load testing to your target QPS.'],
                ['title' => 'Launch',          'description' => 'Staged rollout, dashboards, and runbook for your on-call rotation.'],
            ],
            'tech_stack'  => ['Laravel', 'Native PHP', 'PostgreSQL', 'Redis'],
            'icon'        => 'server',
            'is_featured' => false,
            'sort_order'  => 2,
        ]);

        Service::create([
            'slug'                => 'mobile',
            'title'               => 'Mobile Development',
            'subtitle'            => 'Native-feeling apps that stay in sync with your Laravel backend.',
            'overview'            => 'Cross-platform companion apps backed by PHP APIs — shipping the same business logic to web and mobile cleanly.',
            'best_for'            => 'Existing Laravel apps adding a mobile surface, or products where drivers/agents need a dedicated device flow.',
            'engagement_duration' => '8–20 weeks',
            'deliverables'        => [
                'iOS + Android companion app (single codebase)',
                'Offline-first sync layer against your Laravel API',
                'Push notifications wired to queued jobs',
                'App Store + Play Store submission + assets',
                'Versioned API contract between web + mobile',
            ],
            'process' => [
                ['title' => 'UX Alignment', 'description' => "We validate that mobile doesn't duplicate web — only the flows that belong on the device."],
                ['title' => 'Build',        'description' => 'Mobile app + any Laravel API changes, in lockstep. Single feature-flagged staging env.'],
                ['title' => 'Beta',         'description' => 'TestFlight / Play internal track with real users. Iterate based on crash + analytics.'],
                ['title' => 'Release',      'description' => 'Store submission, review, and a staged rollout. Post-launch crash monitoring.'],
            ],
            'tech_stack'  => ['Laravel', 'PostgreSQL', 'REST APIs'],
            'icon'        => 'phone',
            'is_featured' => false,
            'sort_order'  => 3,
        ]);

        Service::create([
            'slug'                => 'db-design',
            'title'               => 'Database Design',
            'subtitle'            => "Schemas you won't regret in two years.",
            'overview'            => 'PostgreSQL schemas with proper normalization, indexes, and migrations — designed to query fast and stay maintainable.',
            'best_for'            => 'Teams hitting scale pains, or preparing to scale from thousands to millions of rows.',
            'engagement_duration' => '2–6 weeks',
            'deliverables'        => [
                'Schema diagram with entities, relations, and invariants',
                'Migration plan with zero/near-zero downtime strategy',
                'Index audit + query plan review for top 20 queries',
                'Seed + factory setup for local dev and tests',
                'Documentation: why this shape, not another',
            ],
            'process' => [
                ['title' => 'Audit',   'description' => 'Review existing schema, slow-query log, and real workloads. Identify the pain.'],
                ['title' => 'Design',  'description' => 'Propose target schema with rationale. Migration sequence that never blocks writes.'],
                ['title' => 'Migrate', 'description' => 'Ship migrations in reversible steps. Backfill jobs for data transforms.'],
                ['title' => 'Verify',  'description' => 'Benchmark before/after. Document the new shape so it survives team changes.'],
            ],
            'tech_stack'  => ['PostgreSQL', 'Laravel', 'Native PHP'],
            'icon'        => 'db',
            'is_featured' => false,
            'sort_order'  => 4,
        ]);

        Experience::insert([
            ['idx' => '01', 'role' => 'Senior Backend Developer', 'company' => 'Singapore-based Tech Co.', 'location' => 'Remote · Singapore', 'duration' => '2 Years', 'sort_order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['idx' => '02', 'role' => 'Fullstack Laravel Developer', 'company' => 'Regional SaaS Platform', 'location' => 'Jakarta · Indonesia', 'duration' => '2 Years', 'sort_order' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['idx' => '03', 'role' => 'Backend Engineer', 'company' => 'Internal Tools Studio', 'location' => 'Remote', 'duration' => '1 Year', 'sort_order' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['idx' => '04', 'role' => 'Junior PHP Developer', 'company' => 'Digital Agency', 'location' => 'Indonesia', 'duration' => '1.5 Years', 'sort_order' => 4, 'created_at' => now(), 'updated_at' => now()],
        ]);

        $projects = [
            ['slug' => 'fintech-admin', 'title' => 'Fintech Admin Panel', 'tag' => 'Fintech', 'featured' => true, 'year' => '2025', 'sort_order' => 1,
                'desc' => 'Filament-powered admin dashboard for a Singapore payments platform. Role-based permissions, reconciliation, KYC workflows.',
                'tech' => ['Laravel', 'Filament', 'PostgreSQL'], 'thumbnail_url' => null],
            ['slug' => 'livewire-booking', 'title' => 'Livewire Booking System', 'tag' => 'SaaS', 'featured' => false, 'year' => '2025', 'sort_order' => 2,
                'desc' => 'Real-time reservation flow with Livewire components — no SPA complexity, fully reactive, shipped in 6 weeks.',
                'tech' => ['Laravel', 'Livewire', 'Tailwind'], 'thumbnail_url' => null],
            ['slug' => 'headless-commerce', 'title' => 'E-commerce Headless API', 'tag' => 'E-commerce', 'featured' => false, 'year' => '2024', 'sort_order' => 3,
                'desc' => 'REST API powering a Next.js storefront — catalog, cart, checkout, with queued webhook processors.',
                'tech' => ['Laravel', 'Next.js', 'PostgreSQL'], 'thumbnail_url' => null],
            ['slug' => 'lms', 'title' => 'Learning Management System', 'tag' => 'EdTech', 'featured' => false, 'year' => '2024', 'sort_order' => 4,
                'desc' => 'Multi-tenant LMS for regional schools. Built with Livewire and Filament — grade tracking, attendance, parent portal.',
                'tech' => ['Laravel', 'Livewire', 'Filament'], 'thumbnail_url' => null],
            ['slug' => 'inventory-ms', 'title' => 'Inventory Microservice', 'tag' => 'Backend', 'featured' => false, 'year' => '2024', 'sort_order' => 5,
                'desc' => 'Native PHP service handling high-throughput SKU syncs across regional warehouses. Zero downtime migrations.',
                'tech' => ['Native PHP', 'PostgreSQL'], 'thumbnail_url' => null],
            ['slug' => 'cms-site', 'title' => 'Marketing Site + CMS', 'tag' => 'Web', 'featured' => false, 'year' => '2023', 'sort_order' => 6,
                'desc' => 'Headless Filament CMS powering a Next.js marketing site. Editors ship content without touching code.',
                'tech' => ['Filament', 'Next.js', 'Tailwind'], 'thumbnail_url' => null],
            ['slug' => 'hr-portal', 'title' => 'Internal HR Portal', 'tag' => 'Internal Tools', 'featured' => false, 'year' => '2023', 'sort_order' => 7,
                'desc' => 'Payroll, leave, and performance review workflows for a 200-person company. Replaced five legacy spreadsheets.',
                'tech' => ['Laravel', 'Livewire', 'PostgreSQL'], 'thumbnail_url' => null],
            ['slug' => 'delivery-tracking', 'title' => 'Delivery Tracking App', 'tag' => 'Logistics', 'featured' => false, 'year' => '2023', 'sort_order' => 8,
                'desc' => 'Driver-facing mobile app with a Laravel API backend — live GPS, proof-of-delivery capture, dispatcher dashboard.',
                'tech' => ['Laravel', 'PostgreSQL', 'Tailwind'], 'thumbnail_url' => null],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }

        StackItem::insert([
            ['name' => 'Laravel',    'tag' => 'PHP Framework',  'level' => 95, 'primary' => true,  'sort_order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Filament',   'tag' => 'Admin Panel',    'level' => 92, 'primary' => true,  'sort_order' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Livewire',   'tag' => 'Reactive UI',    'level' => 90, 'primary' => true,  'sort_order' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tailwind',   'tag' => 'Styling',        'level' => 88, 'primary' => false, 'sort_order' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'PostgreSQL', 'tag' => 'Database',       'level' => 85, 'primary' => false, 'sort_order' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Native PHP', 'tag' => 'Core Language',  'level' => 90, 'primary' => false, 'sort_order' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Next.js',    'tag' => 'Frontend',       'level' => 80, 'primary' => false, 'sort_order' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Vue.js',     'tag' => 'Frontend',       'level' => 78, 'primary' => false, 'sort_order' => 8, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
