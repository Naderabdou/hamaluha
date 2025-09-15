<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\Provider;
use App\Models\ProviderPackage;
use Filament\Tables\Table;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Filters\SelectFilter;

class DisplayProviderProducts extends Component  implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;


    public $record;

    public function mount($record)
    {
        $this->record = Provider::find($record->id);
    }
    public function table(Table $table): Table
    {
        return $table
            ->emptyStateHeading(__('No Products Found'))
            ->emptyStateIcon('icon-box')
            ->heading(__('Provider Products'))
            ->description(__('List of products of this provider'))
            ->striped()
            ->query(Product::query()->where('provider_id', $this->record->id))
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->default('N/A')
                    ->label(__('Name'))
                    ->sortable(),

                TextColumn::make('price')
                    ->searchable()
                    ->default('N/A')
                    ->label(__('Price'))
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
