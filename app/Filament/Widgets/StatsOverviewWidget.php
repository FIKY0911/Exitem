<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use App\Models\Transaction;
use Filament\Widgets\StatsOverviewWidget as BaseStatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Support\Enums\IconPosition;

class StatsOverviewWidget extends BaseStatsOverviewWidget
{
    protected ?string $pollingInterval = '10s';

    protected function getStats(): array
    {
        $totalRevenue = Transaction::where('is_paid', true)->sum('grand_total_amount');
        $paidCount    = Transaction::where('is_paid', true)->count();
        $unpaidCount  = Transaction::where('is_paid', false)->count();
        $productCount = Product::count();

        // Trend data: last 7 days transactions
        $trend = collect(range(6, 0))->map(fn ($d) =>
            Transaction::where('is_paid', true)
                ->whereDate('created_at', now()->subDays($d))
                ->sum('grand_total_amount')
        )->values()->toArray();

        return [
            Stat::make('Total Products', number_format($productCount))
                ->description('Active catalog items')
                ->descriptionIcon('heroicon-m-cube', IconPosition::Before)
                ->color('primary')
                ->url(route('filament.admin.resources.products.index'))
                ->chart(collect(range(6, 0))->map(fn ($d) =>
                    Product::whereDate('created_at', '<=', now()->subDays($d))->count()
                )->toArray()),

            Stat::make('Paid Transactions', number_format($paidCount))
                ->description('Successfully processed')
                ->descriptionIcon('heroicon-m-check-badge', IconPosition::Before)
                ->color('success')
                ->url(route('filament.admin.resources.transactions.index'))
                ->chart(collect(range(6, 0))->map(fn ($d) =>
                    Transaction::where('is_paid', true)
                        ->whereDate('created_at', now()->subDays($d))
                        ->count()
                )->toArray()),

            Stat::make('Pending Payments', number_format($unpaidCount))
                ->description('Awaiting confirmation')
                ->descriptionIcon('heroicon-m-clock', IconPosition::Before)
                ->color('warning')
                ->url(route('filament.admin.resources.transactions.index'))
                ->chart(collect(range(6, 0))->map(fn ($d) =>
                    Transaction::where('is_paid', false)
                        ->whereDate('created_at', now()->subDays($d))
                        ->count()
                )->toArray()),

            Stat::make('Total Revenue', 'Rp ' . number_format($totalRevenue, 0, ',', '.'))
                ->description('Total income generated')
                ->descriptionIcon('heroicon-m-banknotes', IconPosition::Before)
                ->color('success')
                ->chart($trend),
        ];
    }
}
