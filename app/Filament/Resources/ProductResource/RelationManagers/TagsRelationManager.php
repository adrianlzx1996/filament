<?php

    namespace App\Filament\Resources\ProductResource\RelationManagers;

    use Filament\Forms;
    use Filament\Resources\Form;
    use Filament\Resources\RelationManagers\RelationManager;
    use Filament\Resources\Table;
    use Filament\Tables;

    class TagsRelationManager extends RelationManager
    {
        protected static string $relationship = 'tags';

        protected static ?string $recordTitleAttribute = 'name';

        public static function form ( Form $form )
        : Form {
            return $form
                ->schema([
                             Forms\Components\TextInput::make('name')
                                                       ->required()
                                                       ->maxLength(255),
                         ])
            ;
        }

        public static function table ( Table $table )
        : Table {
            return $table
                ->columns([
                              Tables\Columns\TextColumn::make('name'),
                          ])
                ->headerActions([
                                    Tables\Actions\CreateAction::make(),
                                    Tables\Actions\AttachAction::make(),
                                ])
                ->actions([
                              Tables\Actions\EditAction::make(),
                              //                              Tables\Actions\DeleteAction::make(),
                              Tables\Actions\DetachAction::make(),
                          ])
                ->bulkActions([
//                                  Tables\Actions\DeleteBulkAction::make(),
                              ])
            ;
        }
    }
