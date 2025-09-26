<?php

namespace App\Filament\Resources\Projects\Schemas;

use App\CategoryType;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;
// use App\CategoryType;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
                DateTimePicker::make('start_date'),
                DateTimePicker::make('end_date'),
                FileUpload::make('image_path')
                    ->disk('public')
                    ->downloadable()
                    ->openable()
                    ->image(),
                ToggleButtons::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'on_hold' => 'On hold',
                        'in_progress' => 'In progress',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ])->grouped()
                    ->default('pending')
                    ->required(),
                Select::make('created_by')
                    ->required()->searchable()
                    ->default(Auth::user()->id)
                    ->preload()
                    ->disabled()
                    ->dehydrated(true)
                    ->relationship('creator', 'name'),
                Select::make('updated_by')
                    ->required()->searchable()
                    ->default(Auth::user()->id)
                    ->preload()
                    ->disabled()
                    ->dehydrated(true)
                    ->relationship('updater', 'name'),
                Select::make('client_id')
                    ->relationship('client', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('category_id')
                    ->relationship('category', 'name', function ($query) {
                        $query->where('type', CategoryType::Project);
                    })
                    ->searchable()
                    ->preload()
                    ->required(),
            ]);
    }
}
