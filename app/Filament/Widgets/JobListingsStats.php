<?php

namespace App\Filament\Widgets;

use App\Models\JobListing;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class JobListingsStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make(
                'Ofertas pendientes',
                JobListing::where('status', 'pending')->count()
            )
                ->description('Esperando moderación')
                ->color('warning'),
            Stat::make(
                'Ofertas publicadas',
                JobListing::where('status', 'published')->count()
            )
                ->description('Visibles en UNO Jobs')
                ->color('success'),
            Stat::make(
                'Ofertas rechazadas',
                JobListing::where('status', 'rejected')->count()
            )
                ->description('No visibles públicamente')
                ->color('danger'),
        ];
    }
}
