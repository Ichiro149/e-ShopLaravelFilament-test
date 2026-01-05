<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class OrderItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    protected static ?string $title = 'Order Items';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product_name')
                    ->label('Product')
                    ->searchable(),

                Tables\Columns\TextColumn::make('variant_name')
                    ->label('Variant')
                    ->placeholder('-')
                    ->searchable(),

                Tables\Columns\TextColumn::make('quantity')
                    ->label('Qty')
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('product_price')
                    ->label('Unit Price')
                    ->money('usd'),

                Tables\Columns\TextColumn::make('total')
                    ->label('Total')
                    ->money('usd'),
            ])
            ->paginated(false);
    }
}
