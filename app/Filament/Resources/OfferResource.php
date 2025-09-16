<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Offer;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\OfferResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
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
                Grid::make()->schema([
                    Section::make(__('Category Information'))
                        ->description(__('This is the main information about the category.'))
                        ->collapsible(true)
                        ->schema([
                            Forms\Components\Select::make('provider_id')
                                ->relationship('provider', 'name')
                                ->searchable()
                                ->required(),

                            Forms\Components\TextInput::make('desc_ar')->label('Description (Arabic)'),
                            Forms\Components\TextInput::make('desc_en')->label('Description (English)'),

                            Forms\Components\TextInput::make('discount')
                                ->numeric()
                                ->minValue(0)
                                ->maxValue(100)
                                ->suffix('%'),

                            Forms\Components\FileUpload::make('image')
                                ->image()
                                ->directory('offers')
                                ->disk('public'),

                            Forms\Components\Select::make('type')
                                ->options([
                                    'discount' => 'خصم على منتج واحد',
                                    'offer'    => 'عرض على مجموعة منتجات',
                                ])
                                ->required()
                                ->reactive(),

                            // لو النوع خصم على منتج واحد
                            Forms\Components\Select::make('product_id')
                                ->label('المنتج')
                                ->relationship('products', 'name')
                                ->visible(fn ($get) => $get('type') === 'discount')
                                ->searchable(),

                            // لو النوع عرض على مجموعة منتجات
                            Forms\Components\Select::make('products')
                                ->label('المنتجات')
                                ->multiple()
                                ->relationship('products', 'name')
                                ->visible(fn ($get) => $get('type') === 'offer')
                                ->searchable(),

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
}
