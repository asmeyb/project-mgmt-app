<?php

namespace App\Filament\Widgets;

use Filament\Actions\BulkActionGroup;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Task;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;


class RecentTasks extends TableWidget
{
    protected int | string | array $columnSpan = 'full';
    protected static ?int $sort = 1;
    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => Task::query())
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('description')
                    ->limit(20)
                    ->searchable(),
                ImageColumn::make('image_path')
                ->disk('public')
                ->circular(),
                TextColumn::make('status')
                    ->badge(),
                TextColumn::make('priority')
                    ->badge(),
                TextColumn::make('due_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('assignedUser.name')
                    ->searchable(),
                TextColumn::make('project.name')
                    ->searchable(),
                TextColumn::make('creator.name')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('updater.name')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('category.name')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->recordActions([
                //
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }
}
