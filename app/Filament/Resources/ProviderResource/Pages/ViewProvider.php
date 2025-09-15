<?php

namespace App\Filament\Resources\ProviderResource\Pages;

use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\ProviderResource;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use App\Filament\Resources\ProviderResource\Widgets\StatsProviderOverview;

class ViewProvider extends ViewRecord
{

    protected static string $resource = ProviderResource::class;
    protected function getHeaderWidgets(): array
    {

        return [
            StatsProviderOverview::make([
                'record' => $this->record,
            ]),
        ];
    }
}
