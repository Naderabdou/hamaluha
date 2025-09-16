<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Offer;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Infolists\Components\Grid;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use App\Filament\Resources\OfferResource\Pages;
use Filament\Forms\Components\Grid as FormGrid;
use Filament\Infolists\Components\RepeatableEntry;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section as FormSection;
use App\Filament\Resources\OfferResource\RelationManagers;

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
                            Forms\Components\Select::make('provider_id')
                            ->label(__('Provider'))
                                ->options(\App\Models\User::where('type', 'provider')
                                ->pluck('name', 'id'))
                                ->searchable()
                                ->required()
                                ->reactive(),

                            Forms\Components\TextInput::make('desc_ar')->label('Description (Arabic)'),
                            Forms\Components\TextInput::make('desc_en')->label('Description (English)'),

                            Forms\Components\TextInput::make('discount')
                                ->numeric()
                                ->minValue(0)
                                ->maxValue(100)
                                ->suffix('%'),

                            Forms\Components\Select::make('type')
                                ->options([
                                    'discount' => 'خصم على منتج واحد',
                                    'offer'    => 'عرض على مجموعة منتجات',
                                ])
                                ->required()
                                ->reactive(),
                            Forms\Components\FileUpload::make('image')
                            ->image()
                            ->directory('offers')
                            ->disk('public')
                            ->visible(fn($get) => $get('type') === 'offer'),

                            Forms\Components\Select::make('product_id')
                                ->label('المنتج')
                                ->relationship('products', 'id')
                                ->options(function (callable $get) {
                                    $providerId = $get('provider_id');
                                    if (!$providerId) {
                                        return [];
                                    }

                                    return \App\Models\Product::where('provider_id', $providerId)
                                        ->pluck(app()->getLocale() === 'ar' ? 'name_ar' : 'name_en', 'id');
                                })
                                ->getOptionLabelFromRecordUsing(fn($record) => app()->getLocale() === 'ar' ? $record->name_ar : $record->name_en)
                                ->preload()
                                ->visible(fn($get) => $get('type') === 'discount')
                                ->searchable()
                                ->required(fn($get) => $get('type') === 'discount')
                                ->reactive(),

                            Forms\Components\Select::make('products')
                                ->label('المنتجات')
                                ->multiple()
                                ->relationship('products', 'id')
                                ->options(function (callable $get) {
                                    $providerId = $get('provider_id');
                                    if (!$providerId) {
                                        return [];
                                    }

                                    return \App\Models\Product::where('provider_id', $providerId)
                                        ->pluck(app()->getLocale() === 'ar' ? 'name_ar' : 'name_en', 'id');
                                })
                                ->getOptionLabelFromRecordUsing(fn($record) => app()->getLocale() === 'ar' ? $record->name_ar : $record->name_en)
                                ->preload()
                                ->visible(fn($get) => $get('type') === 'offer')
                                ->searchable()
                                ->required(fn($get) => $get('type') === 'offer')
                                ->reactive(),

                            Forms\Components\Toggle::make('is_active')
                                ->label('نشط')
                                ->default(true),

                            Forms\Components\DateTimePicker::make('start_at')->label('تاريخ البداية'),
                            Forms\Components\DateTimePicker::make('end_at')->label('تاريخ النهاية'),
                        ])->columns(1),




                ]),
            ]);
    }

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
                TextColumn::make('provider.name')->label(__('Provider')),
                TextColumn::make('created_at')->dateTime('d/m/Y')->label('تاريخ الإضافة'),
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
                        TextEntry::make('provider.name')->label(__('Provider')),
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
                        ->visible(fn ($record) => $record->type === 'offer')
,
                    ])
                    ->columns(2),

                Section::make(__('Products'))
                    ->schema([
                        RepeatableEntry::make('products')
                            ->schema([
                                TextEntry::make('name_ar')
                                    ->label(__('Name (Arabic)')),
                                TextEntry::make('name_en')
                                    ->label(__('Name (English)')),
                            ])
                            ->columnSpanFull(),
                    ]),

            ])



        ]);
    }
}
