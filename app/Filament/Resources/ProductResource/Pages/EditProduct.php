<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected function afterSave(): void
    {
        $estate = $this->record;
        if ($estate->images) {

            $estate->images()->delete();
        }

        // Fetch the uploaded images from the form
        $uploadedImages = $this->form->getState()['images']; // Use the correct key to get only the images

        // Loop through the images and store them
        foreach ($uploadedImages as $image) {
            $estate->images()->create([
                'image' => $image,
            ]);
        }
    }
}
