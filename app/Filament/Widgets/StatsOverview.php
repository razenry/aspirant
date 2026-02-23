<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use App\Models\Grade;
use App\Models\User;
use Filament\Facades\Filament;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    public static function canView(): bool
    {
        return Filament::auth()->user()->hasRole('super_admin');
    }

    protected function getStats(): array
    {
        $categoriesCount = Category::count();
        $userCount = User::count();
        $gradesCount = Grade::count();

        return [
            Stat::make('Categories', $categoriesCount)->icon('heroicon-o-tag')->color('primary'),
            Stat::make('Users', $userCount)->icon('heroicon-o-users')->color('success'),
            Stat::make('Grades', $gradesCount)->icon('heroicon-o-building-office-2')->color('warning'),
        ];
    }
}
