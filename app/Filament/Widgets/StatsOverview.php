<?php

namespace App\Filament\Widgets;

use App\Models\Experience;
use App\Models\Project;
use App\Models\Service;
use App\Models\StackItem;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected ?string $pollingInterval = null;

    protected function getStats(): array
    {
        $totalProjects = Project::count();
        $featuredProjects = Project::where('featured', true)->count();

        $totalServices = Service::count();
        $featuredServices = Service::where('is_featured', true)->count();

        return [
            Stat::make('Projects', $totalProjects)
                ->description("{$featuredProjects} featured")
                ->descriptionIcon('heroicon-m-star')
                ->color('primary'),

            Stat::make('Services', $totalServices)
                ->description("{$featuredServices} featured")
                ->descriptionIcon('heroicon-m-star')
                ->color('warning'),

            Stat::make('Experiences', Experience::count())
                ->descriptionIcon('heroicon-m-briefcase')
                ->color('success'),

            Stat::make('Stack Items', StackItem::count())
                ->descriptionIcon('heroicon-m-cpu-chip')
                ->color('info'),
        ];
    }
}
