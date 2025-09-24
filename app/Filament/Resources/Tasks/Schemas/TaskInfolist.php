<?php

namespace App\Filament\Resources\Tasks\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TaskInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('description')
                    ->placeholder('-'),
                ImageEntry::make('image_path')
                    ->placeholder('-')
                    ->disk('public')
                    ->circular(),
                TextEntry::make('status')
                    ->badge(),
                TextEntry::make('priority')
                    ->badge(),
                TextEntry::make('due_date')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('assignedUser.name')
                    ->label('Assigned user')
                    ->placeholder('-'),
                TextEntry::make('project.name')
                    ->label('Project'),
                TextEntry::make('created_by')
                    ->numeric(),
                TextEntry::make('updated_by')
                    ->numeric(),
                TextEntry::make('category.name')
                    ->label('Category'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
