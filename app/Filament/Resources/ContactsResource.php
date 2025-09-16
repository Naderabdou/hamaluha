<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactsResource\Pages;
use App\Filament\Resources\ContactsResource\RelationManagers;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

//todo : remove unused imports
//todo why exists Form
//todo : where buttons for reply and delete
//todo : why editing exists
//todo : add view page
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
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->maxLength(20),

                Forms\Components\Textarea::make('message')
                    ->maxLength(65535),

                Forms\Components\Toggle::make('is_replied')
                    ->label('Is Replied?'),
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
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->searchable(),

                Tables\Columns\TextColumn::make('phone'),

                Tables\Columns\TextColumn::make('message')
                    ->limit(50)
                    ->tooltip(fn ($record) => $record->message),

                Tables\Columns\IconColumn::make('is_replied')
                    ->boolean()
                    ->label('Replied'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d M Y H:i')
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
            'index' => Pages\ListContacts::route('/'),
            // 'create' => Pages\CreateContacts::route('/create'),
            'edit' => Pages\EditContacts::route('/{record}/edit'),
        ];
    }
}
