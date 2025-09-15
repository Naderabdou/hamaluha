<?php

namespace App\Filament\Resources\UserResource\Pages;

use Filament\Actions;
use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\UserResource\Widgets\StatsUserOverview;

class ViewUser extends ViewRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderWidgets(): array
    {

        return [
            StatsUserOverview::make([
                'record' => $this->record,
            ]),
        ];
    }
}
