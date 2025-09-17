<?php

namespace App\Filament\Resources;

use App\Models\User;
use Filament\Tables;
use App\Enums\UserType;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Infolists\Components\Grid;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use App\Filament\Resources\UserResource\Pages;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'icon-students';
    protected static ?int $navigationSort = 5;

    public static function getModelLabel(): string
    {
        return __('User');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Users');
    }


    public static function table(Table $table): Table
    {
        return $table
            ->emptyStateHeading(__('No Users'))
            ->emptyStateDescription(__('Try creating a new user.'))
            ->emptyStateIcon('icon-students')
            ->striped()
            ->heading(__('Users'))
            ->description(__('This is the list of all users'))
            ->modifyQueryUsing(function (Builder $query) {
                return $query->latest('created_at')->where('type',  UserType::USER);
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

                ToggleColumn::make('is_notify')
                    ->label(__('Is Notify'))
                    ->disabled()
                    ->sortable(),





            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                ])
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
            'index' => Pages\ListUsers::route('/'),
            'view' => Pages\ViewUser::route('/{record}'),

        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([

            Grid::make()->schema([

                Section::make(__('Main Information'))
                    ->description(__('This is the main information about the user.'))
                    ->collapsible()
                    ->schema([
                        ImageEntry::make('image')
                            ->label(__('Image'))
                            ->circular()
                            ->size(120),

                        TextEntry::make('name')
                            ->label(__('Name')),

                        TextEntry::make('email')
                            ->label(__('Email')),
                    ]),

            ])


        ]);
    }
}
