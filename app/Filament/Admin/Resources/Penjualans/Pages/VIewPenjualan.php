<?php

namespace App\Filament\Admin\Resources\Penjualans\Pages;

use App\Filament\Admin\Resources\Penjualans\PenjualanResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPenjualan extends ViewRecord
{
    protected static string $resource = PenjualanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}