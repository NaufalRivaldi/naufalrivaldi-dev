<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Projects\ProjectResource;
use App\Models\Project;
use Filament\Actions\Action;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestProjects extends TableWidget
{
    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->heading('Latest Projects')
            ->query(fn (): Builder => Project::query()->latest()->limit(5))
            ->columns([
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('tag')
                    ->badge()
                    ->color('primary'),
                TextColumn::make('client')
                    ->placeholder('—'),
                TextColumn::make('year'),
                IconColumn::make('featured')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->label('Added')
                    ->since(),
            ])
            ->recordActions([
                Action::make('edit')
                    ->icon(Heroicon::OutlinedPencilSquare)
                    ->url(fn (Project $record): string => ProjectResource::getUrl('edit', ['record' => $record])),
            ])
            ->paginated(false);
    }
}
