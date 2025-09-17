<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Contact;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Infolists\Components\Grid;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use App\Filament\Resources\ContactsResource\Pages;

class ContactsResource extends Resource
{
    protected static ?string $model = Contact::class;

protected static ?string $navigationIcon = 'Contact';

    protected static ?int $navigationSort = 3;


    // }
    public static function getModelLabel(): string
    {
        return __('Contact Messages');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Contact Messages');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->emptyStateHeading(__('No Contact Messages'))
            ->emptyStateDescription(__('Try creating a new contact message.'))
            ->emptyStateIcon('Contact')
            ->striped()
            ->heading(__('Contact Messages'))
            ->description(__('This is the list of all contact messages'))
            ->modifyQueryUsing(function (Builder $query) {
                return $query->latest('created_at');
            })
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->searchable(),

                TextColumn::make('phone'),

                ToggleColumn::make('is_replied')
                    ->label('Replied'),

                TextColumn::make('created_at')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListContacts::route('/'),
            // 'create' => Pages\CreateContacts::route('/create'),
            // 'edit' => Pages\EditContacts::route('/{record}/edit'),
            'view' => Pages\ViewContacts::route('/{record}'),
        ];
    }


    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([

            Grid::make()->schema([

                Section::make(__('Contact Details'))
                    ->schema([
                    TextEntry::make('name')->label(__('Name')),
                    TextEntry::make('email')->label(__('Email')),
                    TextEntry::make('phone')->label(__('Phone')),
                    TextEntry::make('created_at')->label(__('Created At'))->dateTime('d M Y H:i'),
                    TextEntry::make('message')->label(__('Message')),

                    ])
                    ->columns(2),

            ])



        ]);
    }
}
