<?php

namespace App\Filament\Resources;

use App\Models\User;
use Filament\Tables;
use App\Enums\UserType;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Hidden;
use Filament\Infolists\Components\Grid;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rules\Password;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Livewire;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Forms\Components\Grid as FormGrid;
use App\Filament\Resources\ProviderResource\Pages;
use Filament\Forms\Components\Section as FormSection;

class ProviderResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'icon-provider';
    protected static ?int $navigationSort = 4;

    public static function getModelLabel(): string
    {
        return __('Provider');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Providers');
    }



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FormGrid::make()->schema([
                    FormSection::make(__('Main Information'))
                        ->description(__('This is the main information about the provider.'))
                        ->collapsible(true)
                        ->schema([
                            FileUpload::make('image')
                                ->required()
                                ->label(__('Image'))
                                ->disk('public')->directory('providers')
                                ->columnSpanFull()
                                ->reorderable()
                                ->image()
                                ->circleCropper()
                                ->maxSize(2048),
                            TextInput::make('name')
                                ->label(__('Name'))
                                ->required()
                                ->maxLength(255),
                            TextInput::make('email')
                                ->email()
                                ->required()
                                ->label(__('Email'))
                                ->maxLength(255)
                                ->unique(ignoreRecord: true),
                            TextInput::make('phone')
                                ->required()
                                ->label(__('Phone'))
                                ->tel()
                                ->maxLength(255)
                                ->unique(ignoreRecord: true),
                            TextInput::make('desc')
                                ->required()
                                ->label(__('Description'))
                                ->maxLength(255),
                            TextInput::make('password')
                                ->label(__('Password'))
                                ->hidden(fn(Page $livewire): bool => $livewire instanceof EditRecord)
                                ->password()
                                ->required()
                                ->revealable(filament()->arePasswordsRevealable())
                                ->rule(Password::default())
                                ->autocomplete('new-password')
                                ->dehydrated(fn($state): bool => filled($state))
                                ->dehydrateStateUsing(fn($state): string => Hash::make($state))
                                ->live(debounce: 500)
                                ->same('passwordConfirmation'),
                            TextInput::make('passwordConfirmation')
                                ->label(__('Password Confirmation'))
                                ->password()
                                ->revealable(filament()->arePasswordsRevealable())
                                ->required()
                                ->visible(fn(Get $get): bool => filled($get('password')))
                                ->dehydrated(false),

                            Hidden::make('type')
                                ->default(UserType::PROVIDER)
                        ]),
                ]),

            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->emptyStateHeading(__('No Providers Found'))
            ->emptyStateDescription(__('Try creating a new provider.'))
            ->emptyStateIcon('icon-provider')
            ->striped()
            ->heading(__('Providers'))
            ->description(__('This table lists all providers. You can manage their information here.'))
            ->modifyQueryUsing(function (Builder $query) {
                return $query->latest('created_at')->where('type', UserType::PROVIDER);
            })
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->default('N/A')
                    ->label(__('Name'))
                    ->sortable(),

                TextColumn::make('email')
                    ->searchable()
                    ->default('N/A')
                    ->label(__('Email'))
                    ->sortable(),
                TextColumn::make('phone')
                    ->searchable()
                    ->default('N/A')
                    ->label(__('Phone'))
                    ->sortable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\ViewAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProviders::route('/'),
            'create' => Pages\CreateProvider::route('/create'),
            'edit' => Pages\EditProvider::route('/{record}/edit'),
            'view' => Pages\ViewProvider::route('/{record}'),
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([

            Grid::make()->schema([

                Section::make(__('Main Information'))
                    ->description(__('This is the main information about the provider.'))
                    ->collapsible()
                    ->schema([
                        ImageEntry::make('image')
                            ->label(__('Image'))
                            ->circular()
                            ->size(120)
                            ->columnSpanFull(),

                        TextEntry::make('name')
                            ->label(__('Name')),

                        TextEntry::make('email')
                            ->label(__('Email')),

                        TextEntry::make('phone')
                            ->label(__('Phone')),

                        TextEntry::make('desc')
                            ->label(__('Description'))
                            ->columnSpanFull(),
                    ])->columns(3),

                Section::make(__('Products'))
                    ->description(__('List of products of this provider.'))
                    ->collapsible(true)
                    ->schema([
                        Livewire::make(
                            'display-provider-products',
                            ['products' => $infolist->record]
                        )

                    ])
                    ->columns(1),

                Section::make(__('Offers'))
                    ->description(__('This is the offers section.'))
                    ->collapsible(true)
                    ->schema([
                        Livewire::make(
                            'display-provider-offers',
                            ['offers' => $infolist->record]
                        )

                    ])
                    ->columns(1),

            ])



        ]);
    }
}
