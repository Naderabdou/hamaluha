<?php

namespace App\Filament\Resources;

use App\Models\User;
use Filament\Tables;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rules\Password;
use App\Filament\Resources\EmployeeResource\Pages;

class EmployeeResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?int $navigationSort = 7;

    protected static ?string $navigationIcon = 'icon-role';


    public static function getModelLabel(): string
    {
        return __('Employee');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Employees');
    }


    public static function form(Form $form): Form
    {
        return $form->schema([
            Grid::make()->schema([
                Section::make(__('Main Information'))
                    ->description(__('This is the main information about the employee.'))
                    ->collapsible(true)
                    ->schema([
                        TextInput::make('name')
                            ->label(__('Name'))
                            ->required()
                            ->minLength(3)
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
                            ->minLength(10)
                            ->unique(ignoreRecord: true),
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

                        Select::make('roles')
                            ->label(__('Role'))
                            ->placeholder(__('Select Role'))
                            ->searchable()
                            ->preload()
                            ->relationship('roles', 'name', fn($query) => $query->whereNotIn('name', ['admin', 'super_admin', 'user']))
                            ->required()
                            ->selectablePlaceholder(false),
                    ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->heading(__('Employees'))
            ->striped()
            ->description(__('This is the employees information.'))

            ->modifyQueryUsing(function (Builder $query) {
                return $query->whereHas('roles', function ($query) {
                    $query->whereNotIn('name', ['admin', 'super_admin', 'user']);
                });
            })
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('Name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label(__('Email Address'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label(__('Phone'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('roles.name')
                    ->label(__('Roles'))
                    ->badge()
                    ->color('info')
                    ->searchable(),

            ])
            ->filters([])
            ->actions([Tables\Actions\ActionGroup::make([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])])
            ->bulkActions(
                [
                    Tables\Actions\BulkActionGroup::make(
                        [
                            Tables\Actions\DeleteBulkAction::make()->hidden(fn() => !auth()->user()->can('delete_user'))
                        ]
                    )
                ]
            );
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
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
