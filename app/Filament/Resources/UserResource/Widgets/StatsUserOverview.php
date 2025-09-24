<?php

namespace App\Filament\Resources\UserResource\Widgets;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use EightyNine\FilamentAdvancedWidget\AdvancedStatsOverviewWidget\Card;
use EightyNine\FilamentAdvancedWidget\AdvancedStatsOverviewWidget\Stat;
use EightyNine\FilamentAdvancedWidget\AdvancedStatsOverviewWidget as BaseWidget;

class StatsUserOverview extends BaseWidget
{
    public ?Model $record = null;
    protected function getStats(): array
    {
        $customer = User::find($this->record->id);

        $total_purchases = $customer->total_purchases;
        $orders_count = $customer->orders()->count();

        return [
            // Stat::make(__('Total Offers'), $total_offers . ' ')->icon('icon-box')
            //     ->progress($total_offers)
            //     ->progressBarColor('primary')
            //     ->chartColor('primary')
            //     ->description(__('Total Offers'))
            //     ->descriptionIcon('heroicon-o-chevron-up', 'before')
            //     ->descriptionColor('primary')
            //     ->iconColor('primary')
            //     ->iconPosition('start'),

            // Stat::make(__('Total Products'),  $products . '')->icon('products')
            //     ->progress($products)
            //     ->progressBarColor('warning')
            //     ->chartColor('warning')
            //     ->description(__('Total Products'))
            //     ->descriptionIcon('heroicon-o-chevron-up', 'before')
            //     ->descriptionColor('warning')
            //     ->iconPosition('start')
            //     ->iconColor('warning'),

            Stat::make(__('Orders Count'),  $orders_count . '')->icon('orders')
                ->progress($orders_count)
                ->progressBarColor('primary')
                ->chartColor('primary')
                ->description(__('Orders Count'))
                ->descriptionIcon('heroicon-o-chevron-up', 'before')
                ->descriptionColor('primary')
                ->iconPosition('start')
                ->iconColor('primary'),

            Stat::make(__('Total Purchases'),  $total_purchases . '')->icon('icon-coin')
                ->progress($total_purchases)
                ->progressBarColor('warning')
                ->chartColor('warning')
                ->description(__('Total Purchases'))
                ->descriptionIcon('heroicon-o-chevron-up', 'before')
                ->descriptionColor('warning')
                ->iconColor('warning')
                ->iconPosition('start'),


        ];
    }

}
