<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ProjectInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('description')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('start_date')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('end_date')
                    ->dateTime()
                    ->placeholder('-'),
                ImageEntry::make('image_path')
                    ->placeholder('-')
                    ->disk('public')
                    ->circular(),
                TextEntry::make('status')
                    ->badge(),
                TextEntry::make('created_by')
                    ->numeric(),
                TextEntry::make('updated_by')
                    ->numeric(),
                TextEntry::make('client.name')
                    ->label('Client'),
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
