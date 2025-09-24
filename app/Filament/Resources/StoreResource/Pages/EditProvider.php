<?php

namespace App\Filament\Resources\StoreResource\Pages;

use App\Filament\Resources\StoreResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProvider extends EditRecord
{
    protected static string $resource = StoreResource::class;

    // protected function getHeaderActions(): array
    // {
    //     return [
            // Actions\DeleteAction::make(),
    //     ];
    // }
}
