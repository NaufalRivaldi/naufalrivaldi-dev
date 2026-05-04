<?php

namespace App\Filament\Resources\Experiences\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ExperiencesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('role')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('company')
                    ->searchable(),
                TextColumn::make('location')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('duration')
                    ->toggleable(),
                TextColumn::make('idx')
                    ->label('Index')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('sort_order')
                    ->label('Order')
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
                Filter::make('location')
                    ->schema([
                        TextInput::make('location')
                            ->placeholder('e.g. Jakarta'),
                    ])
                    ->query(fn (Builder $query, array $data): Builder => $query->when(
                        filled($data['location'] ?? null),
                        fn (Builder $query) => $query->where('location', 'like', "%{$data['location']}%"),
                    ))
                    ->indicateUsing(fn (array $data): ?string => filled($data['location'] ?? null)
                        ? "Location: {$data['location']}"
                        : null),
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
