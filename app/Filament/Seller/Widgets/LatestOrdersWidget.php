<?php

namespace App\Filament\Seller\Widgets;

use App\Models\Order;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Auth;

class LatestOrdersWidget extends BaseWidget
{
    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 'full';

    protected static ?string $heading = 'Latest Orders';

    public function table(Table $table): Table
    {
        $user = Auth::user();
        $companyId = $user?->company?->id;

        return $table
            ->query(
                Order::query()
                    ->with(['user', 'status'])
                    ->whereHas('items.product', function ($query) use ($companyId) {
                        $query->where('company_id', $companyId);
                    })
                    ->latest()
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('order_number')
                    ->label('Order #')
                    ->searchable(),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Customer'),

                Tables\Columns\TextColumn::make('total')
                    ->label('Total')
                    ->money('USD'),

                Tables\Columns\TextColumn::make('status.name')
                    ->label('Status')
                    ->badge()
                    ->color(fn ($record) => match ($record->status?->slug) {
                        'pending' => 'warning',
                        'processing' => 'info',
                        'shipped' => 'primary',
                        'delivered' => 'success',
                        'cancelled' => 'danger',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date')
                    ->dateTime()
                    ->sortable(),
            ])
            ->paginated(false);
    }
}
