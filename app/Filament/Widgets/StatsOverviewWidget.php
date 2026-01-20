<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('total');
        $totalUsers = User::count();
        $totalProducts = Product::where('is_active', true)->count();
        $lowStockProducts = Product::where('stock_quantity', '<', 10)->where('is_active', true)->count();

        return [
            Stat::make('Total Orders', $totalOrders)
                ->description('All time orders')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('primary')
                ->chart([7, 3, 4, 5, 6, 3, 5]),

            Stat::make('Revenue', '$'.number_format($totalRevenue, 2))
                ->description('Total revenue')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('success')
                ->chart([3, 5, 7, 6, 8, 9, 10]),

            Stat::make('Users', $totalUsers)
                ->description('Registered users')
                ->descriptionIcon('heroicon-m-users')
                ->color('info')
                ->chart([2, 4, 6, 5, 7, 8, 9]),

            Stat::make('Active Products', $totalProducts)
                ->description($lowStockProducts > 0 ? $lowStockProducts.' low stock' : 'All stocked')
                ->descriptionIcon($lowStockProducts > 0 ? 'heroicon-m-exclamation-triangle' : 'heroicon-m-check-circle')
                ->color($lowStockProducts > 0 ? 'warning' : 'success'),
        ];
    }
}
