<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\User;
use App\Models\UserSubscription;
use App\Models\ProviderSubscription;
use EightyNine\FilamentAdvancedWidget\AdvancedStatsOverviewWidget\Stat;
use EightyNine\FilamentAdvancedWidget\AdvancedStatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected ?array $cachedData = null;

    protected function getStats(): array
    {
        $data = $this->getCachedData();

        return [
            Stat::make(__('Total Users'), $data['progressUserCount'] . ' ')->icon('icon-students')
                ->progress($data['progressuUser'])
                ->progressBarColor('primary')
                ->chartColor('primary')
                ->description(__('Total Users'))
                ->descriptionIcon('heroicon-o-chevron-up', 'before')
                ->descriptionColor('primary')
                ->iconColor('primary')
                ->iconPosition('start'),

            Stat::make(__('Total Orders User'), $data['progressOrderUserCount'] . ' ')->icon('icon-box')
                ->progress($data['progressOrderUser'])
                ->progressBarColor('primary')
                ->chartColor('primary')
                ->description(__('Total Orders User'))
                ->descriptionIcon('heroicon-o-chevron-up', 'before')
                ->descriptionColor('primary')
                ->iconColor('primary')
                ->iconPosition('start'),

            Stat::make(__('Total Providers'), $data['progressuProviderCount'] . ' ')->icon('icon-provider')
                ->progress($data['progressuProvider'])
                ->progressBarColor('primary')
                ->chartColor('primary')
                ->description(__('Total Providers'))
                ->descriptionIcon('heroicon-o-chevron-up', 'before')
                ->descriptionColor('primary')
                ->iconColor('primary')
                ->iconPosition('start'),

        ];
    }

    protected function getData(): array
    {
        $userCount = User::where('type', 'user')->count();
        $providerCount = User::where('type', 'provider')->count();
        $orderProviderCount = Order::count();
        $orderUserCount = Order::count();

        return [
            'progressuUser' => min($userCount, 100),
            'progressUserCount' => $userCount,
            'progressuProvider' => min($providerCount, 100),
            'progressuProviderCount' => $providerCount,
            'progressOrderProvider' => min($orderProviderCount, 100),
            'progressOrderProviderCount' => $orderProviderCount,
            'progressOrderUser' => min($orderUserCount, 100),
            'progressOrderUserCount' => $orderUserCount,
        ];
    }


    protected function getCachedData(): array
    {
        return $this->cachedData ??= $this->getData();
    }
}
