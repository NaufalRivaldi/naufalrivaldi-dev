<?php

namespace App\Filament\Resources\Services\Tables;

use App\Enums\ServiceIcon;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ServicesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('slug')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('icon')
                    ->formatStateUsing(fn (ServiceIcon $state) => $state->label())
                    ->badge()
                    ->color('gray'),
                TextColumn::make('best_for')
                    ->label('Best For')
                    ->searchable()
                    ->formatStateUsing(fn ($state) => str()->limit($state, 70, '...')),
                TextColumn::make('engagement_duration')
                    ->label('Duration')
                    ->toggleable(),
                ToggleColumn::make('is_featured')
                    ->sortable(),
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
            ->filters([
                SelectFilter::make('icon')
                    ->options(ServiceIcon::options()),
                Filter::make('is_featured')
                    ->label('Featured only')
                    ->query(fn (Builder $query): Builder => $query->where('is_featured', true))
                    ->toggle(),
            ])
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
