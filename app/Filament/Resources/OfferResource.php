<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OfferResource\Pages;
use App\Models\Offer;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid as FormGrid;
use Filament\Forms\Components\Section as FormSection;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class OfferResource extends Resource
{
    protected static ?string $model = Offer::class;

    protected static ?string $navigationIcon = 'offer';

    protected static ?int $navigationSort = 3;

    public static function getModelLabel(): string
    {
        return __('Offer');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Offers');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FormGrid::make()->schema([
                    FormSection::make(__('Category Information'))
                        ->description(__('This is the main information about the category.'))
                        ->collapsible(true)
                        ->schema([
                            Select::make('store_id')
                                ->label(__('Provider'))
                                ->relationship('store', 'name')
                                ->searchable()
                                ->preload()
                                ->required()
                                ->reactive(),

                            Select::make('type')
                                ->label(__('Type of Offer'))
                                ->options([
                                    'discount' => __('discount on a single product'),
                                    'offer' => __('offer on a group of products'),
                                ])
                                ->required()
                                ->reactive(),

                            Select::make('product_id')
                                ->label('المنتج')
                                ->relationship('products', 'name_'.app()->getLocale(), fn ($query, Get $get) => $query->where('store_id', $get('store_id')))
                                ->multiple(fn (Get $get) => $get('type') == 'offer' ? true : false)
                                ->searchable()
                                ->preload()
                                ->required(fn ($get) => $get('type') === 'discount')
                                ->reactive(),

                            TextInput::make('desc_ar')
                                ->label(__('Description (Arabic)'))
                                ->required()
                                ->minLength(5)
                                ->regex('/^[\p{Arabic}\p{N}\s]+$/u'),

                            TextInput::make('desc_en')
                                ->label(__('Description (English)'))
                                ->required()
                                ->minLength(5)
                                ->regex('/^[a-zA-Z0-9\s]+$/u'),

                            TextInput::make('discount')
                                ->label(__('Discount'))
                                ->numeric()
                                ->minValue(0)
                                ->maxValue(100)
                                ->suffix('%'),

                            FileUpload::make('image')
                                ->image()
                                ->directory('offers')
                                ->disk('public')
                                ->visible(fn ($get) => $get('type') === 'offer'),
                            // Select::make('products')
                            //     ->label('المنتجات')
                            //     ->multiple()
                            //     ->relationship('products', 'id')
                            //     ->options(function (callable $get) {
                            //         $storeId = $get('store_id');
                            //         if (! $storeId) {
                            //             return [];
                            //         }

                            //         return \App\Models\Product::where('store_id', $storeId)
                            //             ->pluck(app()->getLocale() === 'ar' ? 'name_ar' : 'name_en', 'id');
                            //     })
                            //     ->getOptionLabelFromRecordUsing(fn ($record) => app()->getLocale() === 'ar' ? $record->name_ar : $record->name_en)
                            //     ->preload()
                            //     ->visible(fn ($get) => $get('type') === 'offer')
                            //     ->searchable()
                            //     ->required(fn ($get) => $get('type') === 'offer')
                            //     ->reactive(),

                            Toggle::make('is_active')
                                ->label(__('Active'))
                                ->default(true),

                            DateTimePicker::make('start_at')
                                ->label(__('Start Date'))
                                ->before('end_at')
                                ->afterOrEqual(now())
                                ->required(),

                            DateTimePicker::make('end_at')
                                ->label(__('End Date'))
                                ->after('start_at')
                                ->required(),
                        ])->columns(1),

                ]),
            ]);
    }

    // protected function afterCreate(): void
    // {
    //     if ($this->data['type'] === 'offer' && isset($this->data['products'])) {
    //         $this->record->products()->sync($this->data['products']);
    //     }

    //     if ($this->data['type'] === 'discount' && isset($this->data['product_id'])) {
    //         $this->record->products()->sync([$this->data['product_id']]);
    //     }
    // }

    public static function table(Table $table): Table
    {
        return $table
            ->emptyStateHeading(__('No Offers Found'))
            ->emptyStateDescription(__('Start by creating a new offer.'))
            ->emptyStateIcon('offer')
            ->striped()
            ->heading(__('Offers'))
            ->description(__('Offers are the main offers of the application.'))
            ->modifyQueryUsing(function (Builder $query) {
                return $query->latest('created_at');
            })
            ->columns([
                TextColumn::make('desc')->label(__('description'))->searchable(),
                TextColumn::make('discount')->label(__('discount')),
                TextColumn::make('store.name')->label(__('Provider')),
                TextColumn::make('created_at')->dateTime('d/m/Y')->label(__('Created At')),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOffers::route('/'),
            'create' => Pages\CreateOffer::route('/create'),
            'view' => Pages\ViewOffer::route('/{record}'),
            'edit' => Pages\EditOffer::route('/{record}/edit'),
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([

            Grid::make()->schema([

                Section::make(__('Offer Details'))
                    ->schema([
                        TextEntry::make('store.name')->label(__('Provider')),
                        TextEntry::make('desc')->label(__('Description')),
                        TextEntry::make('discount')->label(__('Discount')),
                        TextEntry::make('type')->label(__('Type'))
                            ->formatStateUsing(fn ($state) => $state === 'discount' ? 'خصم على منتج واحد' : 'عرض على مجموعة منتجات'),
                        TextEntry::make('is_active')
                            ->label(__('Activation'))
                            ->formatStateUsing(fn ($state) => $state ? __('active') : __('No')),
                        TextEntry::make('start_at')->label(__('Start Date')),
                        TextEntry::make('end_at')->label(__('End Date')),
                        ImageEntry::make('image')->label(__('Image'))
                            ->visible(fn ($record) => $record->type === 'offer'),
                    ])
                    ->columns(2),

                Section::make(__('Products in Offer'))
                    ->schema([
                        RepeatableEntry::make('products')
                            ->label(__('Products'))
                            ->schema([
                                TextEntry::make('name_'.app()->getLocale())
                                    ->label(__('Name')),
                                TextEntry::make('price')
                                    ->label(__('Price')),
                            ])
                            ->columns(3),
                    ]),

            ]),

        ]);
    }
}
