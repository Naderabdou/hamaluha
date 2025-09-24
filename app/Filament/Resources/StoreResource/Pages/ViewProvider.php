<?php

namespace App\Filament\Resources\StoreResource\Pages;

use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\StoreResource;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use App\Filament\Resources\StoreResource\Widgets\StatsStoreOverview;

class ViewProvider extends ViewRecord
{

    protected static string $resource = StoreResource::class;
    protected function getHeaderWidgets(): array
    {
        return [
            StatsStoreOverview::make([
                'record' => $this->record,
            ]),
        ];
    }
}
