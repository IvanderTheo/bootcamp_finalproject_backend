<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            //
            Stat::make('Total User', 120),
            Stat::make('Total Produk', 50),
            Stat::make('Total Penjualan', 'Rp 5.000.000'),
        ];
    }
}
