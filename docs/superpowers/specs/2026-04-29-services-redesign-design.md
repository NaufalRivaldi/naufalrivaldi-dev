# Services Feature Redesign — Design Spec

**Date:** 2026-04-29  
**Scope:** Backend only (Filament admin panel). Frontend integration is a separate phase.

---

## Overview

Redesign the `services` table and its Filament admin resource to support the full data shape required by the service detail page. Currently the frontend uses hardcoded array data in `ServiceDetail.php`; this spec defines the database schema that will replace it.

---

## 1. Database Schema

**Migration strategy:** Drop and recreate the `services` table via a new migration (Option A). The existing migration remains untouched; the new migration runs after it.

### Table: `services`

| Column | Type | Constraints | Notes |
|---|---|---|---|
| `id` | bigint | PK, auto-increment | |
| `slug` | varchar(255) | unique, not null | URL identifier |
| `title` | varchar(255) | not null | |
| `subtitle` | varchar(255) | not null | Catchy tagline shown under the title |
| `overview` | text | not null | Main description paragraph |
| `best_for` | varchar(255) | not null | Short text, ideal client description |
| `engagement_duration` | varchar(255) | not null | e.g. "6–24 weeks" |
| `deliverables` | json | not null | `string[]` — "What you get" list |
| `process` | json | not null | `{title: string, description: string}[]` |
| `tech_stack` | json | not null | `string[]` — tech names |
| `icon` | varchar(255) | not null | One of: `code`, `server`, `phone`, `db` |
| `is_featured` | boolean | default false | |
| `sort_order` | integer | default 0 | Controls display order |
| `created_at` | timestamp | nullable | |
| `updated_at` | timestamp | nullable | |

**Dropped from old schema:** `number` (2-char display number — derivable via `str_pad($sort_order, 2, '0', STR_PAD_LEFT)`), `desc`, `featured`.

---

## 2. Model — `App\Models\Service`

Update `$fillable` to cover all new columns. Add `casts()`:

```php
protected function casts(): array
{
    return [
        'deliverables' => 'array',
        'process'      => 'array',
        'tech_stack'   => 'array',
        'is_featured'  => 'boolean',
    ];
}
```

---

## 3. Filament Admin Panel

### Form — `ServiceForm`

| Field | Component | Notes |
|---|---|---|
| `slug` | `TextInput` | Required, unique (ignoreRecord) |
| `title` | `TextInput` | Required |
| `subtitle` | `TextInput` | Required |
| `icon` | `Select` | Options: code, server, phone, db |
| `best_for` | `TextInput` | Required |
| `engagement_duration` | `TextInput` | Required, e.g. "6–24 weeks" |
| `overview` | `Textarea` | Required, rows 4, columnSpanFull |
| `deliverables` | `TagsInput` | Required, with common suggestions |
| `process` | `Repeater` | Each item: `TextInput` title + `Textarea` description |
| `tech_stack` | `TagsInput` | Suggestions: Laravel, Filament, Livewire, Tailwind, PostgreSQL, etc. |
| `is_featured` | `Toggle` | |
| `sort_order` | `TextInput` (numeric) | Default 0 |

### Table — `ServicesTable`

Columns: `title`, `subtitle` (limit), `icon`, `is_featured` (boolean icon), `sort_order` (sortable).  
Default sort: `sort_order` ascending.  
Record actions: Edit.  
Toolbar actions: BulkDelete.

---

## 4. Seeder

Update `PortfolioSeeder` to use `Service::create()` per record (required for JSON casting). Seed 4 records from the existing hardcoded data in `ServiceDetail.php`, mapped to new column names:

| slug | title |
|---|---|
| `web-apps` | Web App Development |
| `backend-apis` | Backend & APIs |
| `mobile` | Mobile Development |
| `db-design` | Database Design |

Each record will include all JSON fields (`deliverables`, `process`, `tech_stack`) populated from the current hardcoded data.

---

## 5. Out of Scope

- Frontend integration (`ServiceDetail.php` Livewire component and views) — handled in a separate phase.
- Any new services beyond the 4 existing ones.
- Image/file uploads for icons (icon remains a string identifier).
