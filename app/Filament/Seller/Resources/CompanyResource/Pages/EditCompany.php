<?php

namespace App\Filament\Seller\Resources\CompanyResource\Pages;

use App\Filament\Seller\Resources\CompanyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCompany extends EditRecord
{
    protected static string $resource = CompanyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('view_public')
                ->label('View Public Page')
                ->icon('heroicon-o-eye')
                ->url(fn () => route('companies.show', $this->record->slug))
                ->openUrlInNewTab(),
        ];
    }
}
