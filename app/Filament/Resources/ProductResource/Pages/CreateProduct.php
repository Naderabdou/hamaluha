<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    protected function afterCreate(): void
    {

        // Fetch the product instance
        $estate = $this->record;

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

