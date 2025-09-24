<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Product;
use Filament\Forms\Get;
use App\Models\Category;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Infolists\Components\Grid;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Livewire;
use Filament\Infolists\Components\TextEntry;
use Filament\Forms\Components\Grid as FormGrid;
use App\Filament\Resources\ProductResource\Pages;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Forms\Components\Section as FormSection;


class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'products';

    protected static ?int $navigationSort = 2;


    public static function getModelLabel(): string
    {
        return __('Product');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Products');
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FormGrid::make()->schema([
                    FormSection::make(__('Product Information'))
                        ->description(__('This is the main information about the product.'))
                        ->collapsible(true)
                        ->schema([
                            TextInput::make('name_ar')
                                ->label(__('name_ar'))
                                ->required()
                                ->minLength(3)
                                ->maxLength(255)
                                ->regex('/^[\p{Arabic}\p{N}\s]+$/u'),

                            TextInput::make('name_en')
                                ->label(__('name_en'))
                                ->required()
                                ->maxLength(255)
                                ->minLength(3)
                                ->regex('/^[a-zA-Z0-9\s]+$/u'),


                            Textarea::make('desc_ar')
                                ->label(__('desc_ar'))
                                ->required()
                                ->minLength(5)
                                ->regex('/^[\p{Arabic}\p{N}\s]+$/u'),

                            Textarea::make('desc_en')
                                ->label(__('desc_en'))
                                ->required()
                                ->minLength(5)
                                ->regex('/^[a-zA-Z0-9\s]+$/u'),

                            TextInput::make('price')
                                ->numeric()
                                ->required()
                                ->label(__('Price'))
                                ->minValue(1),

                            FileUpload::make('file')
                                ->label(__('ملف المنتج'))
                                ->directory('products/files')
                                ->required()
                                ->maxSize(size: 20000),

                            Select::make('parent_category_id')
                                ->label(__('Main Category'))
                                ->relationship(
                                    name: 'category',
                                    titleAttribute: 'name_' . app()->getLocale(),
                                    modifyQueryUsing: fn($query) => $query->whereNull('parent_id')
                                )
                                ->reactive()
                                ->required(),

                            Select::make('category_id')
                                ->label(__('Sub Category'))
                                ->options(
                                    fn(Get $get) =>
                                    $get('parent_category_id')
                                        ? Category::where('parent_id', $get('parent_category_id'))
                                        ->pluck('name_' . app()->getLocale(), 'id')
                                        : []
                                )
                                ->required()
                                ->reactive()
                                ->disabled(fn(Get $get) => !$get('parent_category_id')),


                            Forms\Components\Select::make('store_id')
                                ->label(__('Store'))
                                ->relationship('store', 'name')
                                ->searchable()
                                ->required(),

                            // Forms\Components\FileUpload::make('images')
                            //     ->label((__('Product Images')))
                            //     ->multiple()
                            //     ->disk('public')
                            //     ->directory('products')
                            //     ->reorderable()
                            //     ->image()
                            //     ->maxFiles(10)
                            //     ->helperText(__('You can upload up to 10 images.'))
                            //     ->afterStateUpdated(function ($state, $record) {
                            //         if ($record) {
                            //             $record->images()->delete();
                            //             foreach ($state as $file) {
                            //                 $record->images()->create([
                            //                     'image' => $file,
                            //                 ]);
                            //             }
                            //         }
                            //     })


                            FileUpload::make('images')
                                ->label(__('images'))
                                ->disk('public')->directory('products')
                                ->columnSpanFull()
                                ->preserveFilenames()
                                ->required()
                                ->image()
                                ->maxSize(4096)
                                ->multiple()
                                ->imageResizeMode('cover')
                                ->imageCropAspectRatio('16:9')
                                ->imageEditor()
                                ->imageEditorViewportWidth('1920')
                                ->imageEditorViewportHeight('1080')
                                ->maxFiles(20)
                                ->minFiles(3)
                                ->hint(new HtmlString(__('يجب ان تكون الصور بجودة عالية وواضحة للمنتج و اقصي عدد 20 صور')))
                                ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg', 'image/svg+xml', 'image/webp'])
                                ->afterStateHydrated(function ($set, $state, $record) {
                                    if ($record && $record->images) {
                                        $set(
                                            'images',
                                            $record->images->pluck('image')->toArray()
                                        );
                                    }
                                }),
                        ])->columns(1),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->emptyStateHeading(__('No Products Found'))
            ->emptyStateDescription(__('Start by creating a new product.'))
            ->emptyStateIcon('icon-app')
            ->striped()
            ->heading(__('Products'))
            ->description(__('Products are the main products of the application.'))
            ->modifyQueryUsing(function (Builder $query) {
                return $query->latest('created_at');
            })
            ->columns([
                TextColumn::make('name_' . app()->getLocale())->label(__('name'))->searchable(),
                TextColumn::make('price')->label(__('price')),
                TextColumn::make('category.name')->label(__('Category')),
                TextColumn::make('store.name')->label(__('Store')),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'view' => Pages\ViewProduct::route('/{record}'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([

            Grid::make()->schema([

                Section::make(__('Main Information'))
                    ->description(__('This is the main information about the product.'))
                    ->collapsible()
                    ->schema([
                        TextEntry::make('name')
                            ->label(__('Name')),
                        TextEntry::make('category.name')
                            ->label(__('Category')),
                        TextEntry::make('store.name')
                            ->label(__('Store')),
                        TextEntry::make('price')
                            ->label(__('Price'))
                            ->money('SAR'),
                        TextEntry::make('desc')
                            ->label(__('Description'))
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make(__('images'))
                    ->description(__('List of images of this product.'))
                    ->collapsible(true)
                    ->schema([
                        Livewire::make(
                            'display-product-images',
                            ['images' => $infolist->record]
                        )

                    ])
                    ->columns(1),


                Section::make(__('Reviews and Ratings'))
                    ->description(__('This is the main information about the reviews.'))
                    ->collapsible()
                    ->schema([
                        TextEntry::make('reviews_count')
                            ->label(__('Total Reviews')),

                        TextEntry::make('average_rating')
                            ->label(__('Average Rating')),

                        RepeatableEntry::make('reviews')
                            ->label(__('Reviews'))
                            ->schema([
                                TextEntry::make('user.name')
                                    ->label(__('User')),

                                TextEntry::make('rating')
                                    ->label(__('Rating')),

                                TextEntry::make('created_at')
                                    ->label(__('Created At'))
                                    ->dateTime('d/m/Y'),

                                TextEntry::make('comment')
                                    ->label(__('Comment'))
                                    ->columnSpanFull(),
                            ])
                            ->columns(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2)



            ])



        ]);
    }
}
