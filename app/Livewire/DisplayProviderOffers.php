<?php

namespace App\Livewire;

use App\Models\Offer;
use App\Models\Product;
use Livewire\Component;
use App\Models\Store;
use App\Models\ProviderPackage;
use Filament\Tables\Table;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Filters\SelectFilter;

class DisplayProviderOffers extends Component  implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;


    public $record;

    public function mount($record)
    {
        $this->record = Store::find($record->id);
    }
    public function table(Table $table): Table
    {
        return $table
            ->emptyStateHeading(__('No Offers Found'))
            ->emptyStateIcon('icon-box')
            ->heading(__('Provider Offers'))
            ->description(__('List of offers of this provider'))
            ->striped()
            ->query(Offer::query()->where('store_id', $this->record->id))
            ->columns([
                TextColumn::make('desc')
                    ->searchable()
                    ->default('N/A')
                    ->label(__('Description'))
                    ->sortable(),

                TextColumn::make('discount')
                    ->searchable()
                    ->default('N/A')
                    ->label(__('Discount'))
                    ->sortable(),
            ])
            ->filters([

            ])
        ;
    }
    public function render()
    {
        return view('livewire.display-provider-products');
    }
}
