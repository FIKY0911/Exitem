<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class TransactionChartWidget extends ChartWidget
{
    protected ?string $heading = 'Revenue & Transactions (Last 30 Days)';

    protected static ?int $sort = 2;
    
    protected ?string $pollingInterval = '15s';

    protected int | string | array $columnSpan = 'full';
    
    protected ?string $maxHeight = '300px';

    public ?string $filter = 'revenue';

    protected function getFilters(): ?array
    {
        return [
            'revenue'      => 'Revenue',
            'transactions' => 'Transaction Count',
        ];
    }

    protected function getData(): array
    {
        $days   = collect(range(29, 0))->map(fn ($d) => now()->subDays($d));
        $labels = $days->map(fn ($d) => $d->format('d M'))->toArray();

        if ($this->filter === 'revenue') {
            $data = $days->map(fn ($d) =>
                Transaction::where('is_paid', true)
                    ->whereDate('created_at', $d)
                    ->sum('grand_total_amount')
            )->toArray();

            return [
                'datasets' => [[
                    'label'           => 'Revenue (Rp)',
                    'data'            => $data,
                    'borderColor'     => '#10b981',
                    'backgroundColor' => 'rgba(16,185,129,0.1)',
                    'fill'            => true,
                    'tension'         => 0.4,
                ]],
                'labels' => $labels,
            ];
        }

        $paid = $days->map(fn ($d) =>
            Transaction::where('is_paid', true)->whereDate('created_at', $d)->count()
        )->toArray();

        $unpaid = $days->map(fn ($d) =>
            Transaction::where('is_paid', false)->whereDate('created_at', $d)->count()
        )->toArray();

        return [
            'datasets' => [
                [
                    'label'           => 'Paid',
                    'data'            => $paid,
                    'borderColor'     => '#10b981',
                    'backgroundColor' => 'rgba(16,185,129,0.1)',
                    'fill'            => true,
                    'tension'         => 0.4,
                ],
                [
                    'label'           => 'Unpaid',
                    'data'            => $unpaid,
                    'borderColor'     => '#f59e0b',
                    'backgroundColor' => 'rgba(245,158,11,0.1)',
                    'fill'            => true,
                    'tension'         => 0.4,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
