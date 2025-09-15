<?php

namespace App\Filament\Resources\ProviderResource\Widgets;

use App\Models\Provider;
use Illuminate\Database\Eloquent\Model;
use EightyNine\FilamentAdvancedWidget\AdvancedStatsOverviewWidget\Card;
use EightyNine\FilamentAdvancedWidget\AdvancedStatsOverviewWidget\Stat;
use EightyNine\FilamentAdvancedWidget\AdvancedStatsOverviewWidget as BaseWidget;

class StatsProviderOverview extends BaseWidget
{
    public ?Model $record = null;
    protected function getStats(): array
    {
        $provider = Provider::find($this->record->id);

        $total_offers = $provider->offers()->count();
        $products = $provider->products()->count();
        $total_revenue = $provider->total_revenue;
        $orders_count = $provider->orders_count;

        return [
            Stat::make(__('Total Offers'), $total_offers . ' ')->icon('icon-box')
                ->progress($total_offers)
                ->progressBarColor('primary')
                ->chartColor('primary')
                ->description(__('Total Offers'))
                ->descriptionIcon('heroicon-o-chevron-up', 'before')
                ->descriptionColor('primary')
                ->iconColor('primary')
                ->iconPosition('start'),

            Stat::make(__('Total Products'),  $products . '')->icon('products')
                ->progress($products)
                ->progressBarColor('warning')
                ->chartColor('warning')
                ->description(__('Total Products'))
                ->descriptionIcon('heroicon-o-chevron-up', 'before')
                ->descriptionColor('warning')
                ->iconPosition('start')
                ->iconColor('warning'),

            Stat::make(__('Orders Count'),  $orders_count . '')->icon('orders')
                ->progress($orders_count)
                ->progressBarColor('primary')
                ->chartColor('primary')
                ->description(__('Orders Count'))
                ->descriptionIcon('heroicon-o-chevron-up', 'before')
                ->descriptionColor('primary')
                ->iconPosition('start')
                ->iconColor('primary'),

            Stat::make(__('Total Revenue'),  $total_revenue . '')->icon('icon-coin')
                ->progress($total_revenue)
                ->progressBarColor('warning')
                ->chartColor('warning')
                ->description(__('Total Revenue'))
                ->descriptionIcon('heroicon-o-chevron-up', 'before')
                ->descriptionColor('warning')
                ->iconColor('warning')
                ->iconPosition('start'),


        ];
    }

}
