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
            'slug' => 'web-apps',
            'title' => 'Web App Development',
            'subtitle' => 'Production Laravel apps, shipped without drama.',
            'overview' => 'End-to-end Laravel + Livewire/Filament web apps with clean architecture and reactive UIs — no page reloads, no compromises.',
            'best_for' => 'Startups needing a full product, or teams replacing a legacy PHP/WordPress monolith.',
            'engagement_duration' => '6–24 weeks',
            'deliverables' => [
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
            'tech_stack' => ['Laravel', 'Filament', 'Livewire', 'Tailwind', 'PostgreSQL'],
            'icon' => 'code',
            'is_featured' => true,
            'sort_order' => 1,
        ]);

        Service::create([
            'slug' => 'backend-apis',
            'title' => 'Backend & APIs',
            'subtitle' => 'The parts nobody sees — but everyone depends on.',
            'overview' => 'Robust REST & resource APIs, queue workers, background jobs, and auth flows built to scale with real production traffic.',
            'best_for' => 'Teams with a frontend (web or mobile) needing a serious backend, or consolidating microservices.',
            'engagement_duration' => '4–12 weeks',
            'deliverables' => [
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
            'tech_stack' => ['Laravel', 'Native PHP', 'PostgreSQL', 'Redis'],
            'icon' => 'server',
            'is_featured' => false,
            'sort_order' => 2,
        ]);

        Service::create([
            'slug' => 'mobile',
            'title' => 'Mobile Development',
            'subtitle' => 'Native-feeling apps that stay in sync with your Laravel backend.',
            'overview' => 'Cross-platform companion apps backed by PHP APIs — shipping the same business logic to web and mobile cleanly.',
            'best_for' => 'Existing Laravel apps adding a mobile surface, or products where drivers/agents need a dedicated device flow.',
            'engagement_duration' => '8–20 weeks',
            'deliverables' => [
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
            'tech_stack' => ['Laravel', 'PostgreSQL', 'REST APIs'],
            'icon' => 'phone',
            'is_featured' => false,
            'sort_order' => 3,
        ]);

        Service::create([
            'slug' => 'db-design',
            'title' => 'Database Design',
            'subtitle' => "Schemas you won't regret in two years.",
            'overview' => 'PostgreSQL schemas with proper normalization, indexes, and migrations — designed to query fast and stay maintainable.',
            'best_for' => 'Teams hitting scale pains, or preparing to scale from thousands to millions of rows.',
            'engagement_duration' => '2–6 weeks',
            'deliverables' => [
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
            'tech_stack' => ['PostgreSQL', 'Laravel', 'Native PHP'],
            'icon' => 'db',
            'is_featured' => false,
            'sort_order' => 4,
        ]);

        Experience::insert([
            ['idx' => '01', 'role' => 'Senior Backend Developer', 'company' => 'Singapore-based Tech Co.', 'location' => 'Remote · Singapore', 'duration' => '2 Years', 'sort_order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['idx' => '02', 'role' => 'Fullstack Laravel Developer', 'company' => 'Regional SaaS Platform', 'location' => 'Jakarta · Indonesia', 'duration' => '2 Years', 'sort_order' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['idx' => '03', 'role' => 'Backend Engineer', 'company' => 'Internal Tools Studio', 'location' => 'Remote', 'duration' => '1 Year', 'sort_order' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['idx' => '04', 'role' => 'Junior PHP Developer', 'company' => 'Digital Agency', 'location' => 'Indonesia', 'duration' => '1.5 Years', 'sort_order' => 4, 'created_at' => now(), 'updated_at' => now()],
        ]);

        $projects = [
            [
                'slug' => 'fintech-admin',
                'title' => 'Fintech Admin Panel',
                'subtitle' => 'Filament-powered admin dashboard for a Singapore payments platform. Role-based permissions, reconciliation, KYC workflows.',
                'tag' => 'Fintech',
                'featured' => true,
                'year' => '2025',
                'sort_order' => 1,
                'client' => 'Singapore Payments Startup',
                'role' => 'Lead Backend Developer',
                'duration' => '8 months',
                'challenge' => 'The client ran critical operations through a patchwork of spreadsheets and a legacy PHP admin. Reconciliation took 2 days per cycle, and role separation for compliance was effectively non-existent.',
                'solution' => 'Rebuilt the admin as a Filament v3 panel on top of Laravel 11 with granular role-based policies, queued reconciliation jobs, and a live KYC review board. Replaced every spreadsheet-driven workflow with auditable resources.',
                'outcome' => [
                    ['k' => 'Reconciliation time', 'v' => '-92%'],
                    ['k' => 'KYC review throughput', 'v' => '3.4×'],
                    ['k' => 'Manual spreadsheets retired', 'v' => '11'],
                ],
                'tech' => ['Laravel', 'Filament', 'PostgreSQL', 'Livewire'],
            ],
            [
                'slug' => 'livewire-booking',
                'title' => 'Livewire Booking System',
                'subtitle' => 'Real-time reservation flow with Livewire components — no SPA complexity, fully reactive, shipped in 6 weeks.',
                'tag' => 'SaaS',
                'featured' => false,
                'year' => '2025',
                'sort_order' => 2,
                'client' => 'Hospitality SaaS',
                'role' => 'Fullstack Developer',
                'duration' => '6 weeks',
                'challenge' => 'The team wanted an SPA-like booking experience without committing to a React frontend and the ops cost that comes with it.',
                'solution' => 'Assembled the booking flow as composable Livewire components — each step owning its own state but sharing an Eloquent booking draft. Redis-backed presence so staff see in-flight bookings.',
                'outcome' => [
                    ['k' => 'Shipped in', 'v' => '6 weeks'],
                    ['k' => 'Time-to-book', 'v' => '-38%'],
                    ['k' => 'Frontend build pipeline', 'v' => 'None'],
                ],
                'tech' => ['Laravel', 'Livewire', 'Tailwind', 'PostgreSQL'],
            ],
            [
                'slug' => 'headless-commerce',
                'title' => 'E-commerce Headless API',
                'subtitle' => 'REST API powering a Next.js storefront — catalog, cart, checkout, with queued webhook processors.',
                'tag' => 'E-commerce',
                'featured' => false,
                'year' => '2024',
                'sort_order' => 3,
                'client' => 'Regional Retailer',
                'role' => 'Backend Engineer',
                'duration' => '4 months',
                'challenge' => 'A monolithic storefront was throttling both the design team and the order-processing pipeline. Checkout stalls during campaigns.',
                'solution' => 'Split the stack: Laravel as the headless API + order engine, Next.js as the storefront, Horizon workers for webhook fan-out to WMS and accounting.',
                'outcome' => [
                    ['k' => 'Checkout p95 latency', 'v' => '-61%'],
                    ['k' => 'Campaign uptime', 'v' => '100%'],
                    ['k' => 'Frontend deploys / week', 'v' => '12'],
                ],
                'tech' => ['Laravel', 'Next.js', 'PostgreSQL', 'Tailwind'],
            ],
            [
                'slug' => 'lms',
                'title' => 'Learning Management System',
                'subtitle' => 'Multi-tenant LMS for regional schools. Built with Livewire and Filament — grade tracking, attendance, parent portal.',
                'tag' => 'EdTech',
                'featured' => false,
                'year' => '2024',
                'sort_order' => 4,
                'client' => 'School Network',
                'role' => 'Fullstack Developer',
                'duration' => '5 months',
                'challenge' => 'A 14-school network needed one system for grades, attendance, and parent communication — tenant-isolated but centrally administrated.',
                'solution' => 'Multi-tenant Laravel app with a shared Filament super-admin and per-school Livewire portals. Row-level isolation via tenant scopes and per-tenant storage disks.',
                'outcome' => [
                    ['k' => 'Schools onboarded', 'v' => '14'],
                    ['k' => 'Active parents', 'v' => '6,200+'],
                    ['k' => 'Legacy systems retired', 'v' => '3'],
                ],
                'tech' => ['Laravel', 'Livewire', 'Filament', 'PostgreSQL'],
            ],
            [
                'slug' => 'inventory-ms',
                'title' => 'Inventory Microservice',
                'subtitle' => 'Native PHP service handling high-throughput SKU syncs across regional warehouses. Zero downtime migrations.',
                'tag' => 'Backend',
                'featured' => false,
                'year' => '2024',
                'sort_order' => 5,
                'client' => 'Logistics Group',
                'role' => 'Backend Engineer',
                'duration' => '3 months',
                'challenge' => 'A shared database was the bottleneck for five regional warehouses syncing SKU counts — contention during peak hours caused 30-min stock-outs on the storefront.',
                'solution' => 'Carved out a native-PHP inventory service with its own PostgreSQL cluster, event-driven sync to the legacy DB, and blue/green migration plan that never paused writes.',
                'outcome' => [
                    ['k' => 'Stock-out windows', 'v' => 'Eliminated'],
                    ['k' => 'SKU sync throughput', 'v' => '5.8×'],
                    ['k' => 'Downtime during migration', 'v' => '0 min'],
                ],
                'tech' => ['Native PHP', 'PostgreSQL'],
            ],
            [
                'slug' => 'cms-site',
                'title' => 'Marketing Site + CMS',
                'subtitle' => 'Headless Filament CMS powering a Next.js marketing site. Editors ship content without touching code.',
                'tag' => 'Web',
                'featured' => false,
                'year' => '2023',
                'sort_order' => 6,
                'client' => 'SaaS Marketing Team',
                'role' => 'Fullstack Developer',
                'duration' => '2 months',
                'challenge' => "Marketing couldn't publish without engineering help. Every landing page was a PR.",
                'solution' => 'Filament CMS with block-based content models feeding a Next.js site via a typed content API. Editors compose pages from pre-approved blocks; preview is live.',
                'outcome' => [
                    ['k' => 'Marketing-led launches / month', 'v' => '9'],
                    ['k' => 'Eng dependency on pages', 'v' => '0'],
                    ['k' => 'Core Web Vitals', 'v' => 'All green'],
                ],
                'tech' => ['Filament', 'Next.js', 'Tailwind'],
            ],
            [
                'slug' => 'hr-portal',
                'title' => 'Internal HR Portal',
                'subtitle' => 'Payroll, leave, and performance review workflows for a 200-person company. Replaced five legacy spreadsheets.',
                'tag' => 'Internal Tools',
                'featured' => false,
                'year' => '2023',
                'sort_order' => 7,
                'client' => '200-person Company',
                'role' => 'Fullstack Developer',
                'duration' => '4 months',
                'challenge' => 'HR operations ran through five spreadsheets and an email chain. Review cycles slipped every quarter.',
                'solution' => 'Laravel + Livewire portal with role-based views for staff, managers, and HR. Filament admin for payroll config, Livewire for employee self-service.',
                'outcome' => [
                    ['k' => 'Spreadsheets retired', 'v' => '5'],
                    ['k' => 'Review cycle time', 'v' => '-55%'],
                    ['k' => 'Self-service adoption', 'v' => '94%'],
                ],
                'tech' => ['Laravel', 'Livewire', 'PostgreSQL'],
            ],
            [
                'slug' => 'delivery-tracking',
                'title' => 'Delivery Tracking App',
                'subtitle' => 'Driver-facing mobile app with a Laravel API backend — live GPS, proof-of-delivery capture, dispatcher dashboard.',
                'tag' => 'Logistics',
                'featured' => false,
                'year' => '2023',
                'sort_order' => 8,
                'client' => 'Last-mile Logistics',
                'role' => 'Fullstack Developer',
                'duration' => '3 months',
                'challenge' => 'Dispatchers had no visibility into in-flight deliveries. Drivers reported status by phone call.',
                'solution' => 'Laravel API + PostgreSQL/PostGIS for routing, companion mobile app for drivers, dispatcher dashboard with live map and SLA timers.',
                'outcome' => [
                    ['k' => 'Dispatcher calls to drivers', 'v' => '-78%'],
                    ['k' => 'On-time delivery', 'v' => '+22pp'],
                    ['k' => 'Proof-of-delivery capture', 'v' => '100%'],
                ],
                'tech' => ['Laravel', 'PostgreSQL', 'Tailwind'],
            ],
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
