<?php

namespace App\Filament\Resources;

use App\Models\Goal;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\GoalsResource\Pages;


class GoalsResource extends Resource
{
    protected static ?string $model = Goal::class;

    protected static ?string $navigationIcon = 'Feature';

    protected static ?int $navigationSort = 10;


    public static function getModelLabel(): string
    {
        return __('Goal');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Goals');
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()->schema([
                    Section::make(__('Main Information'))
                        ->description(__('This is the main information about the goal.'))
                        ->collapsible(true)
                        ->schema([
                            TextInput::make('goal_ar')
                                ->label(__('Goal in Arabic'))
                                ->required()
                                ->maxLength(255)
                                ->minLength(3)
                                ->regex('/^[\p{Arabic}\p{N}\s]+$/u'),
                            TextInput::make('goal_en')
                                ->label(__('Goal in English'))
                                ->required()
                                ->maxLength(255)
                                ->minLength(3)
                                ->regex('/^[a-zA-Z0-9\s]+$/u'),
                        ])
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->emptyStateHeading(__('No Goals'))
            ->emptyStateDescription(__('Try creating a new goal.'))
            ->emptyStateIcon('Feature')
            ->striped()
            ->heading(__('Goals'))
            ->description(__('This is the list of all goals'))
            ->modifyQueryUsing(function (Builder $query) {
                return $query->latest('created_at');
            })
            ->columns([
                TextColumn::make('goal')
                    ->label(__('Goal'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label(__('Created At'))
                    ->dateTime()
                    ->sortable()
                    ->since(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListGoals::route('/'),
            'create' => Pages\CreateGoals::route('/create'),
            'edit' => Pages\EditGoals::route('/{record}/edit'),
        ];
    }
}
