<?php

namespace App\Filament\Resources;

use Filament\Tables;
use App\Models\Partiner;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PartinerResource\Pages;

class PartinerResource extends Resource
{
    protected static ?string $model = Partiner::class;

    protected static ?string $navigationIcon = 'partners';

    protected static ?int $navigationSort = 9;


    public static function getModelLabel(): string
    {
        return __('Partner');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Partners');
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()->schema([
                    Section::make(__('Partner Information'))
                        ->description(__('This is the main information about the partner.'))
                        ->collapsible(true)
                        ->schema([
                            TextInput::make('name_ar')
                                ->label(__('name_ar'))
                                ->minLength(3)
                                ->regex('/^[\p{Arabic}\p{N}\s]+$/u')
                                ->maxLength(255)
                                ->unique(ignoreRecord: true)
                                ->autofocus()
                                ->required(),

                            TextInput::make('name_en')
                                ->label(__('name_en'))
                                ->minLength(3)
                                ->maxLength(255)
                                ->regex('/^[a-zA-Z0-9\s]+$/u')
                                ->unique(ignoreRecord: true)
                                ->autofocus()
                                ->required(),

                            FileUpload::make('image')
                                ->required()
                                ->label(__('Image'))
                                ->disk('public')->directory('partners')
                                ->columnSpanFull()
                                ->reorderable()
                                ->image()
                                ->circleCropper()
                                ->maxSize(2048),
                                ])->columns(2),

                        ])->columns(1),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->emptyStateHeading(__('No Partners Found'))
            ->emptyStateDescription(__('Start by adding a new Partner.'))
            ->emptyStateIcon('partners')
            ->striped()
            ->heading(__('Partners'))
            ->description(__('Partners are the main Partners of the application.'))
            ->modifyQueryUsing(function (Builder $query) {
                return $query->latest('created_at');
            })
            ->columns([

                ImageColumn::make('image')
                    ->label(__('Image'))
                    ->circular()
                    ->stacked(),

                Tables\Columns\TextColumn::make('name_' . app()->getLocale())
                    ->label(__('name'))
                    ->searchable()
                    ->sortable(),

            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListPartiners::route('/'),
            'create' => Pages\CreatePartiner::route('/create'),
            'edit' => Pages\EditPartiner::route('/{record}/edit'),
        ];
    }
}
