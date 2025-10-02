<?php

namespace App\Filament\Pages;

use Filament\Forms;
use Filament\Forms\Form;
use App\Rules\EamilDomains;

use Filament\Pages\SettingsPage;
use App\Settings\GeneralSettings;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Cheesegrits\FilamentGoogleMaps\Fields\Map;

class Settings extends SettingsPage
{
    public static function getNavigationGroup(): ?string
    {
        return __('Settings');
    }
    public static function getNavigationLabel(): string
    {
        return __('Settings');
    }
    public function getTitle(): string
    {
        return __('Settings');
    }
    public static function canAccess(): bool
    {
        return auth()->user()->hasRole('super_admin') || auth()->user()->hasRole('admin');
    }

    protected static ?string $navigationIcon = 'icon-settings';
    protected static ?int $navigationSort = 7;
    protected static string $settings = GeneralSettings::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Settings')
                    ->tabs([
                        Tabs\Tab::make(__('General'))
                            ->icon('heroicon-o-cog-6-tooth')
                            ->badge(4)
                            ->schema([
                                TextInput::make('site_name_ar')
                                    ->label(__('Site Name (Arabic)'))
                                    ->autofocus()
                                    ->minLength(3)
                                    ->maxLength(255)
                                    ->required(),
                                TextInput::make('site_name_en')
                                    ->label(__('Site Name (English)'))
                                    ->autofocus()
                                    ->minLength(3)
                                    ->maxLength(255)
                                    ->required(),

                                FileUpload::make('logo')
                                    ->label(__('Logo'))
                                    ->image()
                                    ->disk('public')
                                    ->directory('settings')
                                    ->columnSpanFull()
                                    ->reorderable()
                                    ->required(),

                                FileUpload::make('favicon')
                                    ->label(__('Favicon'))
                                    ->image()
                                    ->disk('public')
                                    ->directory('settings')
                                    ->columnSpanFull()

                                    ->reorderable()
                                    ->required(),
                            ])->columns(2),

                        Tabs\Tab::make(__('About'))
                            ->icon('heroicon-o-cog-6-tooth')
                            ->badge(4)
                            ->schema([

                                FileUpload::make('about_img')
                                    ->label(__('About Image'))
                                    ->image()
                                    ->disk('public')
                                    ->directory('settings')
                                    ->columnSpanFull()
                                    ->reorderable()
                                    // ->required()
                                    ,

                                TextInput::make('about_stores_counter')
                                    ->label(__('Stores Counter'))
                                    ->numeric()
                                    ->minValue(0),

                                TextInput::make('about_products_counter')
                                    ->label(__('Products Counter'))
                                    ->numeric()
                                    ->minValue(0),

                                TextInput::make('about_purchases_counter')
                                    ->label(__('Purchases Counter'))
                                    ->numeric()
                                    ->minValue(0),

                                TextInput::make('about_header_ar')
                                    ->label(__('About (Arabic)'))
                                    ->autofocus()
                                    ->minLength(3)
                                    ->maxLength(255)
                                    ->required(),
                                TextInput::make('about_header_en')
                                    ->label(__('About (English)'))
                                    ->autofocus()
                                    ->minLength(3)
                                    ->maxLength(255)
                                    ->required(),

                                RichEditor::make('about_desc_ar')
                                    ->label(__('Description (Arabic)'))
                                    ->autofocus()
                                    ->minLength(3)


                                    ->required(),
                                RichEditor::make('about_desc_en')
                                    ->label(__('Description (English)'))
                                    ->autofocus()
                                    ->minLength(3)
                                    ->required(),


                                RichEditor::make('vision_ar')
                                    ->label(__('Vision (Arabic)'))
                                    ->autofocus()
                                    ->minLength(3)


                                    ->required(),
                                RichEditor::make('vision_en')
                                    ->label(__('Vision (English)'))
                                    ->autofocus()
                                    ->minLength(3)
                                    ->required(),


                                RichEditor::make('message_ar')
                                    ->label(__('Message (Arabic)'))
                                    ->autofocus()
                                    ->minLength(3)


                                    ->required(),
                                RichEditor::make('message_en')
                                    ->label(__('Message (English)'))
                                    ->autofocus()
                                    ->minLength(3)
                                    ->required(),



                            ])->columns(2),

                        Tabs\Tab::make(__('Pages'))
                            ->icon('heroicon-o-cog-6-tooth')
                            ->badge(4)
                            ->schema([

                                FileUpload::make('hero_man')
                                    ->label(__('Hero Image'))
                                    ->image()
                                    ->disk('public')
                                    ->directory('settings')
                                    ->columnSpanFull()
                                    ->reorderable()
                                    // ->required()
                                    ,

                                RichEditor::make('products_desc_ar')
                                    ->label(__('Products Description (Arabic)'))
                                    ->autofocus()
                                    ->minLength(3)


                                    ->required(),
                                RichEditor::make('products_desc_en')
                                    ->label(__('Products Description (English)'))
                                    ->autofocus()
                                    ->minLength(3)
                                    ->required(),


                                RichEditor::make('offers_desc_ar')
                                    ->label(__('Offers Description (Arabic)'))
                                    ->autofocus()
                                    ->minLength(3)

                                    ->required(),
                                RichEditor::make('offers_desc_en')
                                    ->label(__('Offers Description (English)'))
                                    ->autofocus()
                                    ->minLength(3)
                                    ->required(),

                                RichEditor::make('stores_desc_ar')
                                    ->label(__('Stores Description (Arabic)'))
                                    ->autofocus()
                                    ->minLength(3)

                                    ->required(),
                                RichEditor::make('stores_desc_en')
                                    ->label(__('Stores Description (English)'))
                                    ->autofocus()
                                    ->minLength(3)
                                    ->required(),

                                RichEditor::make('cart_desc_ar')
                                    ->label(__('Cart Description (Arabic)'))
                                    ->autofocus()
                                    ->minLength(3)

                                    ->required(),
                                RichEditor::make('cart_desc_en')
                                    ->label(__('Cart Description (English)'))
                                    ->autofocus()
                                    ->minLength(3)
                                    ->required(),

                                RichEditor::make('partners_desc_ar')
                                    ->label(__('Partners Description (Arabic)'))
                                    ->autofocus()
                                    ->minLength(3)

                                    ->required(),
                                RichEditor::make('partners_desc_en')
                                    ->label(__('Partners Description (English)'))
                                    ->autofocus()
                                    ->minLength(3)
                                    ->required(),

                                RichEditor::make('questions_desc_ar')
                                    ->label(__('Questions Description (Arabic)'))
                                    ->autofocus()
                                    ->minLength(3)

                                    ->required(),
                                RichEditor::make('questions_desc_en')
                                    ->label(__('Questions Description (English)'))
                                    ->autofocus()
                                    ->minLength(3)
                                    ->required(),

                                FileUpload::make('questions_img')
                                    ->label(__('Questions Image'))
                                    ->image()
                                    ->disk('public')
                                    ->directory('settings')
                                    ->columnSpanFull()
                                    ->reorderable()
                                    ->required(),

                                RichEditor::make('contacts_desc_ar')
                                    ->label(__('Contact Us Description (Arabic)'))
                                    ->autofocus()
                                    ->minLength(3)

                                    ->required(),
                                RichEditor::make('contacts_desc_en')
                                    ->label(__('Contact Us Description (English)'))
                                    ->autofocus()
                                    ->minLength(3)
                                    ->required(),
                                FileUpload::make('contacts_banner')
                                    ->label(__('Contact Us Banner'))
                                    ->image()
                                    ->disk('public')
                                    ->directory('settings')
                                    ->columnSpanFull()
                                    ->reorderable()
                                    ->required(),

                            ])->columns(2),



                        Tabs\Tab::make(__('Provider Journey Steps'))
                            ->icon('heroicon-o-truck')
                            ->badge(4)
                            ->schema([

                                TextInput::make('join_us_title_ar')
                                    ->label(__('Join Us Title (Arabic)'))
                                    ->autofocus()
                                    ->minLength(3)
                                    ->maxLength(255)
                                    ->required(),
                                TextInput::make('join_us_title_en')
                                    ->label(__('Join Us Title (English)'))
                                    ->autofocus()
                                    ->minLength(3)
                                    ->maxLength(255)
                                    ->required(),

                                RichEditor::make('join_us_desc_ar')
                                    ->label(__('Join Us Description (Arabic)'))
                                    ->autofocus()
                                    ->minLength(3)
                                    ->required(),
                                RichEditor::make('join_us_desc_en')
                                    ->label(__('Join Us Description (English)'))
                                    ->autofocus()
                                    ->minLength(3)
                                    ->required(),

                                FileUpload::make('join_us_img1')
                                    ->label(__('Join Us First Image'))
                                    ->image()
                                    ->disk('public')
                                    ->directory('settings')
                                    ->columnSpanFull()
                                    ->reorderable()
                                    ->required(),

                                FileUpload::make('join_us_img2')
                                    ->label(__('Join Us Second Image'))
                                    ->image()
                                    ->disk('public')
                                    ->directory('settings')
                                    ->columnSpanFull()
                                    ->reorderable()
                                    ->required(),

                                FileUpload::make('goals_img')
                                    ->label(__('Goals Image'))
                                    ->image()
                                    ->disk('public')
                                    ->directory('settings')
                                    ->columnSpanFull()
                                    ->reorderable()
                                    ->required(),

                                TextInput::make('journey_step1_title_ar')
                                    ->label(__('Step 1 Title (Arabic)'))
                                    ->autofocus()
                                    ->minLength(3)
                                    ->maxLength(255)
                                    ->required(),
                                TextInput::make('journey_step1_title_en')
                                    ->label(__('Step 1 Title (English)'))
                                    ->autofocus()
                                    ->minLength(3)
                                    ->maxLength(255)
                                    ->required(),

                                RichEditor::make('journey_step1_desc_ar')
                                    ->label(__('Step 1 Description (Arabic)'))
                                    ->autofocus()
                                    ->minLength(3)
                                    ->required(),
                                RichEditor::make('journey_step1_desc_en')
                                    ->label(__('Step 1 Description (English)'))
                                    ->autofocus()
                                    ->minLength(3)
                                    ->required(),
                                TextInput::make('journey_step2_title_ar')
                                    ->label(__('Step 2 Title (Arabic)'))
                                    ->autofocus()
                                    ->minLength(3)
                                    ->maxLength(255)
                                    ->required(),
                                TextInput::make('journey_step2_title_en')
                                    ->label(__('Step 2 Title (English)'))
                                    ->autofocus()
                                    ->minLength(3)
                                    ->maxLength(255)
                                    ->required(),
                                RichEditor::make('journey_step2_desc_ar')
                                    ->label(__('Step 2 Description (Arabic)'))
                                    ->autofocus()
                                    ->minLength(3)
                                    ->required(),
                                RichEditor::make('journey_step2_desc_en')
                                    ->label(__('Step 2 Description (English)'))
                                    ->autofocus()
                                    ->minLength(3)
                                    ->required(),
                                TextInput::make('journey_step3_title_ar')
                                    ->label(__('Step 3 Title (Arabic)'))
                                    ->autofocus()
                                    ->minLength(3)
                                    ->maxLength(255)
                                    ->required(),
                                TextInput::make('journey_step3_title_en')
                                    ->label(__('Step 3 Title (English)'))
                                    ->autofocus()
                                    ->minLength(3)
                                    ->maxLength(255)
                                    ->required(),
                                RichEditor::make('journey_step3_desc_ar')
                                    ->label(__('Step 3 Description (Arabic)'))
                                    ->autofocus()
                                    ->minLength(3)
                                    ->maxLength(255)
                                    ->required(),
                                RichEditor::make('journey_step3_desc_en')
                                    ->label(__('Step 3 Description (English)'))
                                    ->autofocus()
                                    ->minLength(3)
                                    ->maxLength(255)
                                    ->required(),
                            ])->columns(2),

                        Tabs\Tab::make(__('Contact Details'))
                            ->icon('heroicon-o-at-symbol')
                            ->badge(11)
                            ->schema([
                                TextInput::make('email')
                                    ->label(__('Email'))
                                    ->autofocus()
                                    ->email()
                                    ->minLength(3)
                                    ->required(),
                                TextInput::make('phone')
                                    ->label(__('Phone'))
                                    ->autofocus()
                                    ->maxLength(15)
                                    ->required(),
                                TextInput::make('whatsapp')
                                    ->label(__('whatsapp'))
                                    ->autofocus()
                                    ->maxLength(20)
                                    ->required(),

                                TextInput::make('googlePlay')
                                    ->label(__('Snapchat'))
                                    ->autofocus()

                                    ->required(),

                                TextInput::make('appStore')
                                    ->label(__('Twitter'))
                                    ->autofocus()

                                    ->required(),

                                TextInput::make('facebook')
                                    ->label(__('Facebook'))
                                    ->autofocus()

                                    ->required(),

                                TextInput::make('instagram')
                                    ->label(__('Instagram'))
                                    ->autofocus()
                                    ->required(),

                                TextInput::make('email')
                                    ->label(__('email'))
                                    ->autofocus()

                                    ->required(),


                                TextInput::make('address')
                                    ->label(__('Address'))
                                    ->autofocus()
                                    ->placeholder(__('Enter your address'))
                                    ->required()
                                    ->columnSpanFull()
                                    ->maxLength(255),
                                Map::make('location')
                                    ->hiddenLabel()
                                    ->columnSpanFull()

                                    ->mapControls([
                                        'mapTypeControl'    => true,
                                        'scaleControl'      => true,
                                        'rotateControl'     => true,
                                        'fullscreenControl' => true,
                                        'searchBoxControl'  => false, // creates geocomplete field inside map
                                        'zoomControl'       => false,
                                    ])
                                    ->height(fn() => '400px') // map height (width is controlled by Filament options)
                                    ->defaultZoom(5) // default zoom level when opening form
                                    ->autocomplete('address') // field on form to use as Places geocompletion field
                                    ->draggable(false) // allow dragging to move marker

                                    ->clickable(false) // allow clicking to move marker

                            ])->columns(2),

                        Tabs\Tab::make(__('Footer & SEO'))
                            ->icon('heroicon-o-cog-6-tooth')
                            ->badge(6)
                            ->schema([
                                FileUpload::make('footer_logo')
                                    ->label(__('Footer Logo'))
                                    ->image()
                                    ->disk('public')
                                    ->directory('settings')
                                    ->columnSpanFull()
                                    ->reorderable()
                                    ->required(),
                                Textarea::make('subscribe_header_ar')
                                    ->label(__('Subscribe Header (Arabic)'))
                                    ->autofocus()
                                    ->minLength(3)
                                    ->required(),
                                Textarea::make('subscribe_header_en')
                                    ->label(__('Subscribe Header (English)'))
                                    ->autofocus()
                                    ->minLength(3)
                                    ->maxLength(255)
                                    ->required(),
                                TextInput::make('desc_header_ar')
                                    ->label(__('Subscribe Description (Arabic)'))
                                    ->autofocus()
                                    ->minLength(3)
                                    ->maxLength(255)
                                    ->required(),
                                TextInput::make('desc_header_en')
                                    ->label(__('Subscribe Description (English)'))
                                    ->autofocus()
                                    ->minLength(3)
                                    ->maxLength(255)
                                    ->required(),
                                Textarea::make('footer_desc_ar')
                                    ->label(__('Footer Description (Arabic)'))
                                    ->autofocus()
                                    ->minLength(3)
                                    ->required(),
                                Textarea::make('footer_desc_en')
                                    ->label(__('Footer Description (English)'))
                                    ->autofocus()
                                    ->minLength(3)
                                    ->maxLength(255)
                                    ->required(),
                                TextInput::make('copy_right_ar')
                                    ->label(__('Copy Right (Arabic)'))
                                    ->autofocus()
                                    ->minLength(3)
                                    ->maxLength(255)
                                    ->required(),
                                TextInput::make('copy_right_en')
                                    ->label(__('Copy Right (English)'))
                                    ->autofocus()
                                    ->minLength(3)
                                    ->maxLength(255)
                                    ->required(),
                                Textarea::make('policy_desc_ar')
                                    ->label(__('Privacy & Policy Description (Arabic)'))
                                    ->autofocus()
                                    ->minLength(3)
                                    ->required(),
                                Textarea::make('policy_desc_en')
                                    ->label(__('Privacy & Policy Description (English)'))
                                    ->autofocus()
                                    ->minLength(3)
                                    ->maxLength(255)
                                    ->required(),
                            ])->columns(2),

                        Tabs\Tab::make(__('Commission & Fees'))
                            ->icon('heroicon-o-banknotes')
                            ->schema([
                                Section::make(__('Commission Settings'))
                                    ->schema([
                                        Toggle::make('enable_commission')
                                            ->label(__('Enable Commission'))
                                            ->default(true),

                                        TextInput::make('commission_percentage')
                                            ->label(__('Commission Percentage (%)'))
                                            ->numeric()
                                            ->minValue(0)
                                            ->maxValue(100)
                                            ->default(10)
                                            ->visible(fn($get) => $get('enable_commission')),
                                    ])
                                    ->columns(2),

                                Section::make(__('Fixed Fee Settings'))
                                    ->schema([
                                        Toggle::make('enable_fixed_fee')
                                            ->label(__('Enable Fixed Fee'))
                                            ->default(false),

                                        TextInput::make('fixed_fee')
                                            ->label(__('Fixed Fee Amount'))
                                            ->numeric()
                                            ->minValue(0)
                                            ->default(0)
                                            ->visible(fn($get) => $get('enable_fixed_fee')),
                                    ])
                                    ->columns(2),
                            ]),


                    ])
            ])->columns(1);
    }
}
