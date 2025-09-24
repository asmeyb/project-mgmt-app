<?php

namespace App\Filament\Resources\Tasks\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;


class TaskForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('description')
                    ->default(null),
                FileUpload::make('image_path')
                    ->image()->disk('public')->directory('tasks')
                    ->downloadable()->openable()->preserveFilenames(),
                ToggleButtons::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'on_hold' => 'On hold',
                        'in_progress' => 'In progress',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ])->grouped()
                    ->default('pending')
                    ->colors([
                        'pending' => 'warning',
                        'on_hold' => 'info',
                        'in_progress' => 'primary',
                        'completed' => 'success',
                        'cancelled' => 'danger'
                    ])
                    ->required(),
                ToggleButtons::make('priority')
                    ->options(['low' => 'Low', 'medium' => 'Medium', 'high' => 'High'])
                    ->default('medium')->grouped()
                    ->colors([
                        'low' => 'info',
                        'medium' => 'warning',
                        'high' => 'success',
                    ])
                    ->required(),
                DatePicker::make('due_date'),
                Select::make('assigned_user_id')
                    ->relationship('assignedUser', 'name')
                    ->default(null)->searchable()->preload(),
                Select::make('project_id')
                    ->relationship('project', 'name')
                    ->searchable()->preload()
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
                    ->preload()
                    ->disabled()
                    ->default(Auth::user()->id)
                    ->dehydrated(true)
                    ->relationship('updater', 'name'),
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required(),
            ]);
    }
}
