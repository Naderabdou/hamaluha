<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Product;
use App\Models\Category;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Infolists\Components\Grid;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Forms\Components\Grid as FormGrid;
use App\Filament\Resources\ProductResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section as FormSection;
use App\Filament\Resources\ProductResource\RelationManagers;

//todo : remove unused imports
//todo : sub category show main category How to do that?
//todo : in table view show product name based on current locale
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
                            Forms\Components\TextInput::make('name_ar')
                            ->label(__('name_ar'))
                            ->required(),

                            Forms\Components\TextInput::make('name_en')
                                ->label(__('name_en'))
                                ->required(),

                            Forms\Components\Textarea::make('desc_ar')
                                ->label(__('desc_ar')),

                            Forms\Components\Textarea::make('desc_en')
                                ->label(__('desc_en')),

                            Forms\Components\TextInput::make(__('price'))
                                ->numeric()
                                ->required()
                                ->label('السعر'),

                            Forms\Components\FileUpload::make(__('file'))
                                ->label('ملف المنتج')
                                ->directory('products/files'),

                            Forms\Components\Select::make('parent_category_id')
                                ->label(__('Main Category'))
                                ->options(Category::whereNull('parent_id')->pluck('name_ar','id'))
                                ->reactive()
                                ->afterStateUpdated(fn (callable $set) => $set('category_id', null)),

                            Forms\Components\Select::make('category_id')
                                ->label(__('Sub Category'))
                                ->options(fn (callable $get) =>
                                    Category::where('parent_id', $get('parent_category_id'))->pluck('name_ar','id')
                                )
                                ->required()
                                ->reactive(),

                            Forms\Components\Select::make('provider_id')
                                ->label(__('Provider'))
                                ->relationship('provider', 'name')
                                ->searchable()
                                ->required(),

                            Forms\Components\FileUpload::make('images')
                                ->label('صور المنتج')
                                ->multiple()
                                ->directory('products')
                                ->reorderable()
                                ->image()
                                ->maxFiles(10)
                                ->required()
                                ->helperText('ارفع أكتر من صورة للمنتج'),
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
                TextColumn::make('name_ar')->label('الاسم (عربي)')->searchable(),
                TextColumn::make('price')->label('السعر'),
                TextColumn::make('category.name')->label('التصنيف'),
                TextColumn::make('provider.name')->label('البائع'),
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
                        ImageEntry::make('image')
                            ->label(__('Image'))
                            ->circular()
                            ->size(120),
                        TextEntry::make('name')
                            ->label(__('Name')),
                        TextEntry::make('category.name')
                            ->label(__('Category')),
                        TextEntry::make('provider.name')
                            ->label(__('Provider')),
                        TextEntry::make('desc')
                            ->label(__('Description')),
                        TextEntry::make('price')
                        ->label(__('Price')),

                    ]),

                // Section::make(__('Products'))
                //     ->description(__('List of products of this provider.'))
                //     ->collapsible(true)
                //     ->schema([
                //         Livewire::make(
                //             'display-provider-products',
                //             ['products' => $infolist->record]
                //         )

                //     ])
                //  ->columns(1),

            ])



        ]);
    }
}
