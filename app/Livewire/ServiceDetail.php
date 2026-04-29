<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Component;

class ServiceDetail extends Component
{
    public string $slug;

    /** @var array<string, mixed> */
    public array $service = [];

    /** @var array<string, mixed> */
    public array $prev = [];

    /** @var array<string, mixed> */
    public array $next = [];

    /** @return array<int, array<string, mixed>> */
    private function allServices(): array
    {
        return [
            [
                'slug' => 'web-apps',
                'n' => '01',
                'title' => 'Web App Development',
                'icon' => 'code',
                'tagline' => 'Production Laravel apps, shipped without drama.',
                'short' => 'End-to-end Laravel + Livewire/Filament web apps with clean architecture and reactive UIs — no page reloads, no compromises.',
                'bestFor' => 'Startups needing a full product, or teams replacing a legacy PHP/WordPress monolith.',
                'deliverables' => [
                    'Laravel 11+ monolith with domain-driven structure',
                    'Filament v3 admin panel, fully policied',
                    'Livewire-powered reactive UIs for end users',
                    'CI/CD pipeline, staging + production environments',
                    'Handover docs + 30 days post-launch support',
                ],
                'process' => [
                    ['k' => '01', 't' => 'Discovery', 'd' => 'One week of calls + artifact review. I map your domain, surface risks, and propose scope.'],
                    ['k' => '02', 't' => 'Architecture', 'd' => 'DB schema, API contracts, Filament resources, Livewire component tree — signed off before a line of code.'],
                    ['k' => '03', 't' => 'Sprint Delivery', 'd' => 'Two-week sprints, demo every Friday, staging always current. You see progress, not promises.'],
                    ['k' => '04', 't' => 'Launch + Handover', 'd' => 'Production deploy, docs, and 30 days of hands-on support for whoever takes over.'],
                ],
                'tech' => ['Laravel', 'Filament', 'Livewire', 'Tailwind', 'PostgreSQL'],
            ],
            [
                'slug' => 'backend-apis',
                'n' => '02',
                'title' => 'Backend & APIs',
                'icon' => 'server',
                'tagline' => 'The parts nobody sees — but everyone depends on.',
                'short' => 'Robust REST & resource APIs, queue workers, background jobs, and auth flows built to scale with real production traffic.',
                'bestFor' => 'Teams with a frontend (web or mobile) needing a serious backend, or consolidating microservices.',
                'deliverables' => [
                    'REST API with OpenAPI schema + typed SDK',
                    'Queued jobs via Horizon, with retry/backoff policies',
                    'Authentication: Sanctum, OAuth2, or SSO as needed',
                    'Rate limiting, idempotency keys, audit log',
                    'Load test report + scaling plan',
                ],
                'process' => [
                    ['k' => '01', 't' => 'Contract First', 'd' => 'We design the API surface before implementation. Frontend can mock immediately.'],
                    ['k' => '02', 't' => 'Implementation', 'd' => 'Laravel controllers, resources, policies. Tests on every endpoint.'],
                    ['k' => '03', 't' => 'Hardening', 'd' => 'Rate limits, idempotency, observability, load testing to your target QPS.'],
                    ['k' => '04', 't' => 'Launch', 'd' => 'Staged rollout, dashboards, and runbook for your on-call rotation.'],
                ],
                'tech' => ['Laravel', 'Native PHP', 'PostgreSQL', 'Redis'],
            ],
            [
                'slug' => 'mobile',
                'n' => '03',
                'title' => 'Mobile Development',
                'icon' => 'phone',
                'tagline' => 'Native-feeling apps that stay in sync with your Laravel backend.',
                'short' => 'Cross-platform companion apps backed by PHP APIs — shipping the same business logic to web and mobile cleanly.',
                'bestFor' => 'Existing Laravel apps adding a mobile surface, or products where drivers/agents need a dedicated device flow.',
                'deliverables' => [
                    'iOS + Android companion app (single codebase)',
                    'Offline-first sync layer against your Laravel API',
                    'Push notifications wired to queued jobs',
                    'App Store + Play Store submission + assets',
                    'Versioned API contract between web + mobile',
                ],
                'process' => [
                    ['k' => '01', 't' => 'UX Alignment', 'd' => "We validate that mobile doesn't duplicate web — only the flows that belong on the device."],
                    ['k' => '02', 't' => 'Build', 'd' => 'Mobile app + any Laravel API changes, in lockstep. Single feature-flagged staging env.'],
                    ['k' => '03', 't' => 'Beta', 'd' => 'TestFlight / Play internal track with real users. Iterate based on crash + analytics.'],
                    ['k' => '04', 't' => 'Release', 'd' => 'Store submission, review, and a staged rollout. Post-launch crash monitoring.'],
                ],
                'tech' => ['Laravel', 'PostgreSQL', 'REST APIs'],
            ],
            [
                'slug' => 'db-design',
                'n' => '04',
                'title' => 'Database Design',
                'icon' => 'db',
                'tagline' => "Schemas you won't regret in two years.",
                'short' => 'PostgreSQL schemas with proper normalization, indexes, and migrations — designed to query fast and stay maintainable.',
                'bestFor' => 'Teams hitting scale pains, or preparing to scale from thousands to millions of rows.',
                'deliverables' => [
                    'Schema diagram with entities, relations, and invariants',
                    'Migration plan with zero/near-zero downtime strategy',
                    'Index audit + query plan review for top 20 queries',
                    'Seed + factory setup for local dev and tests',
                    'Documentation: why this shape, not another',
                ],
                'process' => [
                    ['k' => '01', 't' => 'Audit', 'd' => 'Review existing schema, slow-query log, and real workloads. Identify the pain.'],
                    ['k' => '02', 't' => 'Design', 'd' => 'Propose target schema with rationale. Migration sequence that never blocks writes.'],
                    ['k' => '03', 't' => 'Migrate', 'd' => 'Ship migrations in reversible steps. Backfill jobs for data transforms.'],
                    ['k' => '04', 't' => 'Verify', 'd' => 'Benchmark before/after. Document the new shape so it survives team changes.'],
                ],
                'tech' => ['PostgreSQL', 'Laravel', 'Native PHP'],
            ],
        ];
    }

    public function mount(string $slug): void
    {
        $all = $this->allServices();
        $idx = collect($all)->search(fn ($s) => $s['slug'] === $slug);

        abort_if($idx === false, 404);

        $this->service = $all[$idx];
        $this->prev = $all[($idx - 1 + count($all)) % count($all)];
        $this->next = $all[($idx + 1) % count($all)];
    }

    public function render(): View
    {
        return view('livewire.service-detail');
    }
}
