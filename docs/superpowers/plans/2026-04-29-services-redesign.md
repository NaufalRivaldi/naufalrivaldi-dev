# Services Redesign Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Replace the minimal `services` database schema and Filament admin resource with a full implementation supporting all service detail page fields.

**Architecture:** A new migration drops and recreates the `services` table. The `Service` model gains JSON casts for three array fields and a boolean cast for `is_featured`. The Filament form uses `TagsInput` for flat string arrays and a `Repeater` for structured process steps. The `PortfolioSeeder` is updated with 4 complete service records sourced from the current hardcoded `ServiceDetail.php` data.

**Tech Stack:** Laravel 13, Filament v4, PostgreSQL, Pest v4

---

## File Map

| Action | Path | Responsibility |
|---|---|---|
| Create | `database/migrations/*_redesign_services_table.php` | Drop + recreate `services` table with new 13-column schema |
| Modify | `app/Models/Service.php` | Update `$fillable` + add JSON and boolean casts |
| Modify | `database/seeders/PortfolioSeeder.php` | Replace 4 Service records with new field structure |
| Modify | `app/Filament/Resources/Services/Schemas/ServiceForm.php` | Full form: `Repeater` for process, `TagsInput` for string arrays |
| Modify | `app/Filament/Resources/Services/Tables/ServicesTable.php` | Updated columns matching new schema |
| Create | `tests/Feature/Services/ServiceTest.php` | Model cast test + Filament resource create/edit/list tests |

---

### Task 1: Create the migration

**Files:**
- Create: `database/migrations/*_redesign_services_table.php`

- [ ] **Step 1: Generate the migration file**

```bash
php artisan make:migration redesign_services_table --no-interaction
```

Expected output: `Created Migration: YYYY_MM_DD_HHMMSS_redesign_services_table`

- [ ] **Step 2: Replace the generated migration body**

Open `database/migrations/*_redesign_services_table.php` and replace its entire contents with:

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('services');

        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('subtitle');
            $table->text('overview');
            $table->string('best_for');
            $table->string('engagement_duration');
            $table->json('deliverables');
            $table->json('process');
            $table->json('tech_stack');
            $table->string('icon');
            $table->boolean('is_featured')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
```

- [ ] **Step 3: Run migrations fresh**

```bash
php artisan migrate:fresh --no-interaction
```

Expected: No errors. All tables dropped and recreated. `services` table now has the 13 new columns.

---

### Task 2: Update the Service model and write a model cast test

**Files:**
- Modify: `app/Models/Service.php`
- Create: `tests/Feature/Services/ServiceTest.php`

- [ ] **Step 1: Create the test file**

```bash
php artisan make:test --pest Services/ServiceTest --no-interaction
```

Expected output: `INFO  Test [tests/Feature/Services/ServiceTest.php] created successfully.`

- [ ] **Step 2: Write a failing model cast test**

Replace the entire contents of `tests/Feature/Services/ServiceTest.php` with:

```php
<?php

use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('casts json columns to arrays', function () {
    $service = Service::create([
        'slug'                => 'test-service',
        'title'               => 'Test',
        'subtitle'            => 'Tagline',
        'overview'            => 'Overview.',
        'best_for'            => 'Startups',
        'engagement_duration' => '4–8 weeks',
        'deliverables'        => ['Item one', 'Item two'],
        'process'             => [['title' => 'Step 1', 'description' => 'Do this.']],
        'tech_stack'          => ['Laravel'],
        'icon'                => 'code',
        'is_featured'         => false,
        'sort_order'          => 1,
    ]);

    $fresh = $service->fresh();

    expect($fresh->deliverables)->toBeArray()
        ->and($fresh->process)->toBeArray()
        ->and($fresh->tech_stack)->toBeArray()
        ->and($fresh->is_featured)->toBeBool();
});
```

- [ ] **Step 3: Run the test to verify it fails**

```bash
php artisan test --compact --filter="casts json columns"
```

Expected: FAIL — `deliverables` is not in `$fillable` so `Service::create()` silently discards it and the freshly retrieved record has `null` instead of an array.

- [ ] **Step 4: Replace `app/Models/Service.php` with the updated model**

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'subtitle',
        'overview',
        'best_for',
        'engagement_duration',
        'deliverables',
        'process',
        'tech_stack',
        'icon',
        'is_featured',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'deliverables' => 'array',
            'process'      => 'array',
            'tech_stack'   => 'array',
            'is_featured'  => 'boolean',
        ];
    }
}
```

- [ ] **Step 5: Run the test to verify it passes**

```bash
php artisan test --compact --filter="casts json columns"
```

Expected: PASS

- [ ] **Step 6: Commit**

```bash
git add database/migrations/*_redesign_services_table.php app/Models/Service.php tests/Feature/Services/ServiceTest.php
git commit -m "feat(services): redesign schema, update model, add cast test"
```

---

### Task 3: Update the PortfolioSeeder

**Files:**
- Modify: `database/seeders/PortfolioSeeder.php`

- [ ] **Step 1: Replace the `Service::insert([...])` block in `PortfolioSeeder.php`**

Find the existing block that starts with `Service::insert([` and replace it entirely with these four `Service::create()` calls (using `create` instead of `insert` so JSON casting is applied during seeding):

```php
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
```

- [ ] **Step 2: Run `migrate:fresh --seed` to verify the seeder works end to end**

```bash
php artisan migrate:fresh --seed --no-interaction
```

Expected: No errors. All tables recreated. 4 services inserted.

- [ ] **Step 3: Verify the record count and JSON fields**

```bash
php artisan tinker --execute 'echo App\Models\Service::count() . " services\n"; $s = App\Models\Service::first(); var_dump(is_array($s->deliverables));'
```

Expected output:
```
4 services
bool(true)
```

- [ ] **Step 4: Commit**

```bash
git add database/seeders/PortfolioSeeder.php
git commit -m "feat(services): update seeder with full service data for new schema"
```

---

### Task 4: Update the Filament form

**Files:**
- Modify: `app/Filament/Resources/Services/Schemas/ServiceForm.php`

- [ ] **Step 1: Replace `ServiceForm.php` entirely**

```php
<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),
                TextInput::make('title')
                    ->required(),
                TextInput::make('subtitle')
                    ->required()
                    ->columnSpanFull(),
                Select::make('icon')
                    ->options([
                        'code'   => 'Code',
                        'server' => 'Server',
                        'phone'  => 'Phone',
                        'db'     => 'Database',
                    ])
                    ->required(),
                TextInput::make('best_for')
                    ->label('Best For')
                    ->required(),
                TextInput::make('engagement_duration')
                    ->label('Engagement Duration')
                    ->placeholder('e.g. 6–24 weeks')
                    ->required(),
                Textarea::make('overview')
                    ->rows(4)
                    ->required()
                    ->columnSpanFull(),
                TagsInput::make('deliverables')
                    ->label('What You Get')
                    ->suggestions([
                        'CI/CD pipeline',
                        'Handover docs',
                        '30 days post-launch support',
                        'OpenAPI schema',
                        'Load test report',
                    ])
                    ->required()
                    ->columnSpanFull(),
                Repeater::make('process')
                    ->schema([
                        TextInput::make('title')
                            ->required(),
                        Textarea::make('description')
                            ->rows(3)
                            ->required(),
                    ])
                    ->required()
                    ->columnSpanFull(),
                TagsInput::make('tech_stack')
                    ->label('Tech Stack')
                    ->suggestions(['Laravel', 'Filament', 'Livewire', 'Tailwind', 'PostgreSQL', 'Native PHP', 'Next.js', 'Redis', 'REST APIs'])
                    ->required()
                    ->columnSpanFull(),
                Toggle::make('is_featured'),
                TextInput::make('sort_order')
                    ->numeric()
                    ->default(0),
            ]);
    }
}
```

---

### Task 5: Update the Filament table

**Files:**
- Modify: `app/Filament/Resources/Services/Tables/ServicesTable.php`

- [ ] **Step 1: Replace `ServicesTable.php` entirely**

```php
<?php

namespace App\Filament\Resources\Services\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ServicesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('subtitle')
                    ->limit(50)
                    ->searchable(),
                TextColumn::make('icon'),
                IconColumn::make('is_featured')
                    ->boolean(),
                TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('sort_order')
            ->filters([])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
```

- [ ] **Step 2: Commit Tasks 4 and 5**

```bash
git add app/Filament/Resources/Services/Schemas/ServiceForm.php app/Filament/Resources/Services/Tables/ServicesTable.php
git commit -m "feat(services): update Filament form and table for new schema"
```

---

### Task 6: Write and run Filament resource tests

**Files:**
- Modify: `tests/Feature/Services/ServiceTest.php`

- [ ] **Step 1: Replace `tests/Feature/Services/ServiceTest.php` with the complete test file**

```php
<?php

use App\Filament\Resources\Services\Pages\CreateService;
use App\Filament\Resources\Services\Pages\EditService;
use App\Filament\Resources\Services\Pages\ListServices;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Livewire\livewire;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->actingAs(User::factory()->create());
});

it('casts json columns to arrays', function () {
    $service = Service::create([
        'slug'                => 'test-service',
        'title'               => 'Test',
        'subtitle'            => 'Tagline',
        'overview'            => 'Overview.',
        'best_for'            => 'Startups',
        'engagement_duration' => '4–8 weeks',
        'deliverables'        => ['Item one', 'Item two'],
        'process'             => [['title' => 'Step 1', 'description' => 'Do this.']],
        'tech_stack'          => ['Laravel'],
        'icon'                => 'code',
        'is_featured'         => false,
        'sort_order'          => 1,
    ]);

    $fresh = $service->fresh();

    expect($fresh->deliverables)->toBeArray()
        ->and($fresh->process)->toBeArray()
        ->and($fresh->tech_stack)->toBeArray()
        ->and($fresh->is_featured)->toBeBool();
});

it('can list services', function () {
    livewire(ListServices::class)->assertOk();
});

it('can render the create page', function () {
    livewire(CreateService::class)->assertOk();
});

it('can create a service', function () {
    livewire(CreateService::class)
        ->fillForm([
            'slug'                => 'new-service',
            'title'               => 'New Service',
            'subtitle'            => 'A short tagline.',
            'overview'            => 'Overview text here.',
            'best_for'            => 'Startups',
            'engagement_duration' => '4–8 weeks',
            'deliverables'        => ['Deliverable one', 'Deliverable two'],
            'process'             => [
                ['title' => 'Step 1', 'description' => 'Do this first.'],
            ],
            'tech_stack'  => ['Laravel', 'Filament'],
            'icon'        => 'code',
            'is_featured' => false,
            'sort_order'  => 5,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    expect(Service::where('slug', 'new-service')->exists())->toBeTrue();
});

it('can render the edit page with existing data', function () {
    $service = Service::create([
        'slug'                => 'edit-test',
        'title'               => 'Edit Test',
        'subtitle'            => 'Subtitle here.',
        'overview'            => 'Overview.',
        'best_for'            => 'Teams',
        'engagement_duration' => '4–8 weeks',
        'deliverables'        => ['Item'],
        'process'             => [['title' => 'Step', 'description' => 'Desc.']],
        'tech_stack'          => ['Laravel'],
        'icon'                => 'server',
        'is_featured'         => false,
        'sort_order'          => 2,
    ]);

    livewire(EditService::class, ['record' => $service->id])
        ->assertOk()
        ->assertSchemaStateSet([
            'title'    => 'Edit Test',
            'subtitle' => 'Subtitle here.',
            'icon'     => 'server',
        ]);
});
```

- [ ] **Step 2: Run all service tests**

```bash
php artisan test --compact --filter=ServiceTest
```

Expected: All 5 tests pass.

- [ ] **Step 3: Commit**

```bash
git add tests/Feature/Services/ServiceTest.php
git commit -m "test(services): add Filament resource and model cast tests"
```

---

### Task 7: Run Pint and final verification

**Files:** All modified PHP files

- [ ] **Step 1: Run Pint on dirty files**

```bash
vendor/bin/pint --dirty --format agent
```

Expected: Pint reports any files it fixed. No errors.

- [ ] **Step 2: Run the full test suite**

```bash
php artisan test --compact
```

Expected: All tests pass.

- [ ] **Step 3: Commit Pint fixes if any files were changed**

Check with `git status`. If Pint modified files:

```bash
git add app/Filament/Resources/Services/Schemas/ServiceForm.php app/Filament/Resources/Services/Tables/ServicesTable.php app/Models/Service.php database/seeders/PortfolioSeeder.php database/migrations/*_redesign_services_table.php
git commit -m "style: apply Pint formatting to services files"
```

If `git status` shows no changes: skip this step.

---

## Self-Review

**Spec coverage:**
- [x] Migration drops + recreates `services` table with all 13 columns — Task 1
- [x] `number` column dropped; `sort_order` retained as integer — Task 1
- [x] Service model updated with all new fillable fields and JSON/boolean casts — Task 2
- [x] Seeder updated with 4 complete records using `Service::create()` (required for JSON casting) — Task 3
- [x] Filament form: `TagsInput` for `deliverables` and `tech_stack`, `Repeater` for `process` — Task 4
- [x] Filament table: updated columns (`title`, `subtitle`, `icon`, `is_featured`, `sort_order`) — Task 5
- [x] Tests: model cast assertions + Filament list/create/edit — Task 6
- [x] Pint formatting on all modified files — Task 7

**Placeholder scan:** No TBDs, no vague steps. All code is complete.

**Type consistency:** `process` items use `title`/`description` keys throughout — seeder, form schema (Repeater sub-fields), and test data all match. `tech_stack` used consistently (not `stack` or `tech`). `is_featured` used consistently (not `featured`).
