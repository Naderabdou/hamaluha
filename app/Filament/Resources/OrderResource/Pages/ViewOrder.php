<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\RepeatableEntry;

class ViewOrder extends ViewRecord
{
    protected static string $resource = OrderResource::class;

    public function infolist(Infolists\Infolist $infolist): Infolists\Infolist
    {
        return $infolist
            ->schema([
                Section::make('Order Details')
                    ->schema([
                        TextEntry::make('order_number')->label('Order #'),
                        TextEntry::make('user.name')->label('Customer'),
                        TextEntry::make('total')->label('Order Total')->money('egp'),
                        TextEntry::make('status')->label('Status'),
                        TextEntry::make('payment_status')->label('Payment Status'),
                        TextEntry::make('created_at')->dateTime('d M Y H:i'),
                    ])
                    ->columns(2),

                Section::make('Order Items')
                    ->schema([
                        RepeatableEntry::make('orderItems')
                            ->schema([
                                TextEntry::make('name')->label('Product'),
                                TextEntry::make('price')->label('Price')->money('egp'),
                                TextEntry::make('admin_earning')->label('Admin Earning')->money('egp'),
                                TextEntry::make('vendor_earning')->label('Vendor Earning')->money('egp'),
                            ])
                            ->columns(4),
                    ]),

                Section::make('Earnings Summary')
                    ->schema([
                        TextEntry::make('admin_total')
                            ->label('Total Admin Earnings')
                            ->money('egp'),

                        TextEntry::make('vendor_total')
                            ->label('Total Vendor Earnings')
                            ->money('egp'),
                    ])
                    ->columns(2),
            ]);
    }
}
