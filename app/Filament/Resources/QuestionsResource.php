<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Question;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\QuestionsResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\QuestionsResource\RelationManagers;

class QuestionsResource extends Resource
{
    protected static ?string $model = Question::class;

protected static ?string $navigationIcon = 'question1';

    protected static ?int $navigationSort = 3;


    // }
    public static function getModelLabel(): string
    {
        return __('Question');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Questions');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()->schema([
                Section::make(__('Main Information'))
                ->description(__('This is the main information about the questions.'))
                ->collapsible(true)
                ->schema([
                    Forms\Components\TextInput::make('question_ar')
                        ->label(__('Question in Arabic'))
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('question_en')
                        ->label(__('Question in English'))
                        ->required()
                        ->maxLength(255),
                    Forms\Components\Textarea::make('answer_ar')
                        ->label(__('Answer in Arabic'))
                        ->required(),
                    Forms\Components\Textarea::make('answer_en')
                        ->label(__('Answer in English'))
                        ->required(),
                ])
            ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->emptyStateHeading(__('No Questions'))
            ->emptyStateDescription(__('Try creating a new question.'))
            ->emptyStateIcon('question1')
            ->striped()
            ->heading(__('Questions'))
            ->description(__('This is the list of all questions'))
            ->modifyQueryUsing(function (Builder $query) {
                return $query->latest('created_at');
            })
            ->columns([
                Tables\Columns\TextColumn::make('question_ar')
                    ->label(__('Question'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('answer_ar')
                    ->label(__('Answer'))
                    ->searchable()
                    ->sortable(),
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
            'index' => Pages\ListQuestions::route('/'),
            'create' => Pages\CreateQuestions::route('/create'),
            'edit' => Pages\EditQuestions::route('/{record}/edit'),
        ];
    }
}
