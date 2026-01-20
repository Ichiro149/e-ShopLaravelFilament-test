<?php

namespace App\Filament\Seller\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class RevenueChartWidget extends ChartWidget
{
    protected static ?string $heading = 'My Revenue (Last 7 Days)';

    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        $user = Auth::user();
        $companyId = $user?->company?->id;

        $data = collect(range(6, 0))->map(function ($daysAgo) use ($companyId) {
            $date = Carbon::now()->subDays($daysAgo);

            $revenue = Order::whereDate('orders.created_at', $date)
                ->whereHas('items.product', function ($query) use ($companyId) {
                    $query->where('company_id', $companyId);
                })
                ->sum('total');

            return [
                'date' => $date->format('M d'),
                'revenue' => $revenue,
            ];
        });

        return [
            'datasets' => [
                [
                    'label' => 'Revenue',
                    'data' => $data->pluck('revenue')->toArray(),
                    'backgroundColor' => 'rgba(245, 158, 11, 0.5)',
                    'borderColor' => 'rgb(245, 158, 11)',
                ],
            ],
            'labels' => $data->pluck('date')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
