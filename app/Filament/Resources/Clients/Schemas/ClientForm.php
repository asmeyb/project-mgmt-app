<?php

namespace App\Filament\Resources\Clients\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;
use BackedEnum;

class ClientForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('phone')
                    ->tel()
                    ->default(null),
                Textarea::make('address')
                    ->default(null)
                    ->columnSpanFull(),
                Select::make('status')
                    ->options(['active' => 'Active', 'in_active' => 'In active'])
                    ->default('active')
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
            ]);
    }
}
