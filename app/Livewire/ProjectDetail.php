<?php

namespace App\Livewire;

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

    /** @return array<int, array<string, mixed>> */
    private function allProjects(): array
    {
        return [
            [
                'slug' => 'fintech-admin',
                'title' => 'Fintech Admin Panel',
                'tag' => 'Fintech',
                'year' => '2025',
                'featured' => true,
                'role' => 'Lead Backend Developer',
                'client' => 'Singapore Payments Startup',
                'duration' => '8 months',
                'short' => 'Filament-powered admin dashboard for a Singapore payments platform. Role-based permissions, reconciliation, KYC workflows.',
                'challenge' => 'The client ran critical operations through a patchwork of spreadsheets and a legacy PHP admin. Reconciliation took 2 days per cycle, and role separation for compliance was effectively non-existent.',
                'solution' => 'Rebuilt the admin as a Filament v3 panel on top of Laravel 11 with granular role-based policies, queued reconciliation jobs, and a live KYC review board. Replaced every spreadsheet-driven workflow with auditable resources.',
                'tech' => ['Laravel', 'Filament', 'PostgreSQL', 'Livewire'],
                'outcome' => [
                    ['k' => 'Reconciliation time', 'v' => '-92%'],
                    ['k' => 'KYC review throughput', 'v' => '3.4×'],
                    ['k' => 'Manual spreadsheets retired', 'v' => '11'],
                ],
                'gallery' => ['dashboard', 'reconciliation', 'kyc-board'],
            ],
            [
                'slug' => 'livewire-booking',
                'title' => 'Livewire Booking System',
                'tag' => 'SaaS',
                'year' => '2025',
                'featured' => false,
                'role' => 'Fullstack Developer',
                'client' => 'Hospitality SaaS',
                'duration' => '6 weeks',
                'short' => 'Real-time reservation flow with Livewire components — no SPA complexity, fully reactive, shipped in 6 weeks.',
                'challenge' => 'The team wanted an SPA-like booking experience without committing to a React frontend and the ops cost that comes with it.',
                'solution' => 'Assembled the booking flow as composable Livewire components — each step owning its own state but sharing an Eloquent booking draft. Redis-backed presence so staff see in-flight bookings.',
                'tech' => ['Laravel', 'Livewire', 'Tailwind', 'PostgreSQL'],
                'outcome' => [
                    ['k' => 'Shipped in', 'v' => '6 weeks'],
                    ['k' => 'Time-to-book', 'v' => '-38%'],
                    ['k' => 'Frontend build pipeline', 'v' => 'None'],
                ],
                'gallery' => ['search', 'calendar', 'confirmation'],
            ],
            [
                'slug' => 'headless-commerce',
                'title' => 'E-commerce Headless API',
                'tag' => 'E-commerce',
                'year' => '2024',
                'featured' => false,
                'role' => 'Backend Engineer',
                'client' => 'Regional Retailer',
                'duration' => '4 months',
                'short' => 'REST API powering a Next.js storefront — catalog, cart, checkout, with queued webhook processors.',
                'challenge' => 'A monolithic storefront was throttling both the design team and the order-processing pipeline. Checkout stalls during campaigns.',
                'solution' => 'Split the stack: Laravel as the headless API + order engine, Next.js as the storefront, Horizon workers for webhook fan-out to WMS and accounting.',
                'tech' => ['Laravel', 'Next.js', 'PostgreSQL', 'Tailwind'],
                'outcome' => [
                    ['k' => 'Checkout p95 latency', 'v' => '-61%'],
                    ['k' => 'Campaign uptime', 'v' => '100%'],
                    ['k' => 'Frontend deploys / week', 'v' => '12'],
                ],
                'gallery' => ['catalog', 'cart', 'admin'],
            ],
            [
                'slug' => 'lms',
                'title' => 'Learning Management System',
                'tag' => 'EdTech',
                'year' => '2024',
                'featured' => false,
                'role' => 'Fullstack Developer',
                'client' => 'School Network',
                'duration' => '5 months',
                'short' => 'Multi-tenant LMS for regional schools. Built with Livewire and Filament — grade tracking, attendance, parent portal.',
                'challenge' => 'A 14-school network needed one system for grades, attendance, and parent communication — tenant-isolated but centrally administrated.',
                'solution' => 'Multi-tenant Laravel app with a shared Filament super-admin and per-school Livewire portals. Row-level isolation via tenant scopes and per-tenant storage disks.',
                'tech' => ['Laravel', 'Livewire', 'Filament', 'PostgreSQL'],
                'outcome' => [
                    ['k' => 'Schools onboarded', 'v' => '14'],
                    ['k' => 'Active parents', 'v' => '6,200+'],
                    ['k' => 'Legacy systems retired', 'v' => '3'],
                ],
                'gallery' => ['grades', 'attendance', 'parent-portal'],
            ],
            [
                'slug' => 'inventory-ms',
                'title' => 'Inventory Microservice',
                'tag' => 'Backend',
                'year' => '2024',
                'featured' => false,
                'role' => 'Backend Engineer',
                'client' => 'Logistics Group',
                'duration' => '3 months',
                'short' => 'Native PHP service handling high-throughput SKU syncs across regional warehouses. Zero downtime migrations.',
                'challenge' => 'A shared database was the bottleneck for five regional warehouses syncing SKU counts — contention during peak hours caused 30-min stock-outs on the storefront.',
                'solution' => 'Carved out a native-PHP inventory service with its own PostgreSQL cluster, event-driven sync to the legacy DB, and blue/green migration plan that never paused writes.',
                'tech' => ['Native PHP', 'PostgreSQL'],
                'outcome' => [
                    ['k' => 'Stock-out windows', 'v' => 'Eliminated'],
                    ['k' => 'SKU sync throughput', 'v' => '5.8×'],
                    ['k' => 'Downtime during migration', 'v' => '0 min'],
                ],
                'gallery' => ['sync-dashboard', 'event-log', 'warehouse-view'],
            ],
            [
                'slug' => 'cms-site',
                'title' => 'Marketing Site + CMS',
                'tag' => 'Web',
                'year' => '2023',
                'featured' => false,
                'role' => 'Fullstack Developer',
                'client' => 'SaaS Marketing Team',
                'duration' => '2 months',
                'short' => 'Headless Filament CMS powering a Next.js marketing site. Editors ship content without touching code.',
                'challenge' => "Marketing couldn't publish without engineering help. Every landing page was a PR.",
                'solution' => 'Filament CMS with block-based content models feeding a Next.js site via a typed content API. Editors compose pages from pre-approved blocks; preview is live.',
                'tech' => ['Filament', 'Next.js', 'Tailwind'],
                'outcome' => [
                    ['k' => 'Marketing-led launches / month', 'v' => '9'],
                    ['k' => 'Eng dependency on pages', 'v' => '0'],
                    ['k' => 'Core Web Vitals', 'v' => 'All green'],
                ],
                'gallery' => ['cms', 'storefront', 'preview'],
            ],
            [
                'slug' => 'hr-portal',
                'title' => 'Internal HR Portal',
                'tag' => 'Internal Tools',
                'year' => '2023',
                'featured' => false,
                'role' => 'Fullstack Developer',
                'client' => '200-person Company',
                'duration' => '4 months',
                'short' => 'Payroll, leave, and performance review workflows for a 200-person company. Replaced five legacy spreadsheets.',
                'challenge' => 'HR operations ran through five spreadsheets and an email chain. Review cycles slipped every quarter.',
                'solution' => 'Laravel + Livewire portal with role-based views for staff, managers, and HR. Filament admin for payroll config, Livewire for employee self-service.',
                'tech' => ['Laravel', 'Livewire', 'PostgreSQL'],
                'outcome' => [
                    ['k' => 'Spreadsheets retired', 'v' => '5'],
                    ['k' => 'Review cycle time', 'v' => '-55%'],
                    ['k' => 'Self-service adoption', 'v' => '94%'],
                ],
                'gallery' => ['dashboard', 'leave', 'reviews'],
            ],
            [
                'slug' => 'delivery-tracking',
                'title' => 'Delivery Tracking App',
                'tag' => 'Logistics',
                'year' => '2023',
                'featured' => false,
                'role' => 'Fullstack Developer',
                'client' => 'Last-mile Logistics',
                'duration' => '3 months',
                'short' => 'Driver-facing mobile app with a Laravel API backend — live GPS, proof-of-delivery capture, dispatcher dashboard.',
                'challenge' => 'Dispatchers had no visibility into in-flight deliveries. Drivers reported status by phone call.',
                'solution' => 'Laravel API + PostgreSQL/PostGIS for routing, companion mobile app for drivers, dispatcher dashboard with live map and SLA timers.',
                'tech' => ['Laravel', 'PostgreSQL', 'Tailwind'],
                'outcome' => [
                    ['k' => 'Dispatcher calls to drivers', 'v' => '-78%'],
                    ['k' => 'On-time delivery', 'v' => '+22pp'],
                    ['k' => 'Proof-of-delivery capture', 'v' => '100%'],
                ],
                'gallery' => ['dispatcher', 'driver-app', 'route-map'],
            ],
        ];
    }

    public function mount(string $slug): void
    {
        $all = $this->allProjects();
        $idx = collect($all)->search(fn ($p) => $p['slug'] === $slug);

        abort_if($idx === false, 404);

        $this->project = $all[$idx];
        $this->prev = $all[($idx - 1 + count($all)) % count($all)];
        $this->next = $all[($idx + 1) % count($all)];
    }

    public function render(): View
    {
        return view('livewire.project-detail');
    }
}
