<?php

namespace App\Filament\Resources\JoinRequestResource\Pages;

use App\Filament\Resources\JoinRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewJoinRequest extends ViewRecord
{
    protected static string $resource = JoinRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
