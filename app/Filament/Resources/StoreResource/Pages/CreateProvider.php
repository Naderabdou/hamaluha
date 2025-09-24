<?php

namespace App\Filament\Resources\StoreResource\Pages;

use App\Filament\Resources\StoreResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProvider extends CreateRecord
{
    protected static string $resource = StoreResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {

        $data['is_active'] = true;
        $data['status'] = 'accepted';

        return $data;
    }

    protected function afterCreate(): void
    {

        $store = $this->record;
        $store->provider->update(['type' => 'provider']);

    }
}
