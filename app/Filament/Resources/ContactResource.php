<?php

namespace App\Filament\Resources;

use Filament\Tables;
use App\Models\Contact;
use App\Mail\MeqeedMail;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Mail;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Notifications\Notification;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use App\Filament\Resources\ContactResource\Pages;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;
    protected static ?int $navigationSort = 14;


    protected static ?string $navigationIcon = 'icon-tech-support';
    public static function getModelLabel(): string
    {
        return __('Contact Us');
    }



    public static function getPluralModelLabel(): string
    {
        return __('Contact Us');
    }



    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                return $query->latest('created_at');
            })
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('name'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->label(__('email'))
                    ->searchable()
                    ->sortable()
                    ->url(fn(Contact $record) => 'mailto:' . $record->email, true), // Redirect to email



                Tables\Columns\TextColumn::make('message')
                    ->label(__('message'))
                    ->searchable()
                    ->words(50)
                    ->wrap()
                    ->sortable(),
                Tables\Columns\TextColumn::make('isReply')
                    ->label(__('isReply'))
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(function (Contact $record) {
                        return $record->isReply == 1 ? __('is replied') : __('not replied');
                    })
                    ->color(fn(string $state): string => match ($state) {


                        '1' => 'success',
                        '0' => 'danger',
                    })
                    ->badge(),
                TextColumn::make('created_at')
                    ->label(__('Created At'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),



            ])
            ->filters([


                SelectFilter::make('isReply')
                    ->label(__('filter by Replay'))

                    ->options([
                        '1' => __('is replied'),
                        '0' => __('not replied'),
                    ])
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([

                    Tables\Actions\ViewAction::make(),
                    Action::make('Send Reply')
                        ->label(__('Send Reply'))
                        ->form([
                            Textarea::make('reply')
                                ->label(__('Reply'))
                                ->minLength(3)

                                ->columnSpan(3)
                                ->rows(5)
                                ->required(),
                        ])
                        ->action(function (Contact $contact, array $data) {


                            //  Mail::to($contact->email)->send(new MeqeedMail($data));

                            $contact->isReply = 1;
                            $contact->save();


                            Notification::make()
                                ->title(__('Reply Sent Successfully'))
                                ->success()
                                ->icon('heroicon-o-inbox')
                                ->iconColor('success')

                                ->send();
                        })->icon('heroicon-o-chat-bubble-left-right')
                ]),



            ])

            ->bulkActions(
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),

                ]),
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
            'index' => Pages\ListContacts::route('/'),
            'view' => Pages\ViewUser::route('/{record}'),
            // 'view' => Pages\ViewCustomerContact::route('/{record}'),

        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {

        return $infolist
            ->schema([
                Section::make(fn(Contact $record) => __('عرض رسالة من') . ' ' . $record->name)
                    ->description(fn(Contact $record) => __('رسالة من') . ' ' . $record->name . ' ' . __('بتاريخ') . ' ' . $record->created_at->format('Y-m-d'))
                    ->schema([
                        TextEntry::make('name')
                            ->label(__('Name')),

                        TextEntry::make('email')
                            ->label(__('Email'))
                            ->url(fn(Contact $record) => 'mailto:' . $record->email, true) // Redirect to email

                        ,

                        TextEntry::make('message')
                            ->label(__('message')),

                        TextEntry::make('isReply')
                            ->label(__('isReply'))
                            ->formatStateUsing(fn(Contact $record) => $record->isReply ? __('is replied') : __('not replied'))
                            ->color(fn(Contact $record) => $record->isReply ? 'success' : 'danger')
                            ->badge(),

                        TextEntry::make('created_at')
                            ->label(__('Created At'))
                            ->dateTime()
                    ])->columns(2),

            ]);
    }
}
