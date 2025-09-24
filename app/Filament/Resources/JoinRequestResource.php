<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Infolists\Components\Grid;
use Filament\Tables\Columns\SelectColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\JoinRequestResource\Pages;
use App\Filament\Resources\JoinRequestResource\RelationManagers;

class JoinRequestResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'documents';
    protected static ?int $navigationSort = 4;

    public static function getModelLabel(): string
    {
        return __('Join Request');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Join Requests');
    }
    // public static function form(Form $form): Form
    // {
    //     return $form
    //         ->schema([
    //             select::make('storeRequest.status')
    //                 ->label(__('Status'))
    //                 ->relationship('storeRequest', 'status')
    //                 ->options([
    //                     'pending' => __('Pending'),
    //                     'accepted' => __('Accepted'),
    //                 ])
    //                 ->required()
    //                 ->default('pending'),

    //             Select::make('type')
    //                 ->label(__('Update user to provider'))
    //                 ->options([
    //                     'user' => __('User'),
    //                     'provider'  => __('Provider'),
    //                 ])
    //                 ->required()
    //                 ->default('user'),
    //         ]);
    // }

    public static function table(Table $table): Table
    {
        return $table
            ->emptyStateHeading(__('No Join Requests Found'))
            ->emptyStateIcon('documents')
            ->striped()
            ->heading(__('Join Requests'))
            ->description(__('Here you can view all join requests.'))
            ->modifyQueryUsing(function (Builder $query) {
                return $query->hasStoreRequest();
            })

            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('Name'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label(__('Email'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('storeRequest.phone')
                    ->label(__('Phone'))
                    ->sortable()
                    ->searchable(),
                SelectColumn::make('storeRequest.status')
                    ->options([
                        'pending' => __('Pending'),
                        'accepted' => __('Accepted'),
                    ])->afterStateUpdated(function ($record, $state) {
                        if($state === 'accepted') {
                            $record->update(['type' => 'provider']);
                        }else{
                            $record->update(['type' => 'user']);
                        }

                    })
                    ->label(__('Status')),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('Created At'))
                    ->dateTime()
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                // Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListJoinRequests::route('/'),
            // 'create' => Pages\CreateJoinRequest::route('/create'),
            'view' => Pages\ViewJoinRequest::route('/{record}'),
            'edit' => Pages\EditJoinRequest::route('/{record}/edit'),
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([

            Grid::make()->schema([

                Section::make(__('Main Information'))
                    ->description(__('This is the main information about the store.'))
                    ->collapsible()
                    ->schema([
                        ImageEntry::make('storeRequest.image')
                            ->label(__('Image'))
                            ->circular()
                            ->size(120)
                            ->columnSpanFull(),

                        TextEntry::make('name')
                            ->label(__('Name')),

                        TextEntry::make('storeRequest.name')
                            ->label(__('Store')),

                        TextEntry::make('storeRequest.email')
                            ->label(__('Email')),

                        TextEntry::make('storeRequest.phone')
                            ->label(__('Phone')),

                        TextEntry::make('storeRequest.desc')
                            ->label(__('Description'))
                            ->columnSpanFull(),
                    ])->columns(4),

            ])



        ]);
    }
}
