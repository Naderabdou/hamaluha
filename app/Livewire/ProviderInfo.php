<?php

namespace App\Livewire;

use App\Models\Store;
use Livewire\Component;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;

class ProviderInfo extends Component implements HasInfolists
{
    use InteractsWithInfolists;

    public Store $provider;

    public function mount($providerId): void
    {
        $this->provider = Store::findOrFail($providerId);
    }

    public function providerInfo(Infolist $infolist): Infolist
    {
        return $infolist
            ->record($this->provider)
            ->schema([
                Grid::make()->schema([
                    Section::make(__('Main Information'))
                        ->description(__('This is the main information about the provider.'))
                        ->collapsible()
                        ->schema([
                            ImageEntry::make('image')
                                ->label(__('Image'))
                                ->circular()
                                ->size(120),

                            TextEntry::make('name')
                                ->label(__('Name')),

                            TextEntry::make('email')
                                ->label(__('Email')),

                            TextEntry::make('phone')
                                ->label(__('Phone')),

                            TextEntry::make('desc')
                                ->label(__('Description')),

                        ]),
                ]),
            ]);
    }

    public function render()
    {
        return view('livewire.provider-info');
    }
}
