<?php

namespace App\Filament\Widgets;

use App\Models\Client;
use App\Models\Task;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\User;
use App\Models\Project;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;

class SystemOverview extends StatsOverviewWidget
{
    use HasWidgetShield;
    protected static ?int $sort = 0;
    protected function getStats(): array
    {
        return [
            Stat::make('Number of Users', User::count()),
            Stat::make('Number of Projects', Project::count()),
            Stat::make('Number of Clients', Client::count()),
            Stat::make('Number of Tasks', Task::count())
        ];
    }
}
