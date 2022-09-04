<?php

    namespace App\Filament\Resources;

    use App\Filament\Resources\TagResource\Pages;
    use App\Filament\Resources\TagResource\RelationManagers;
    use App\Models\Tag;
    use Filament\Forms\Components\TextInput;
    use Filament\Resources\Form;
    use Filament\Resources\Resource;
    use Filament\Resources\Table;
    use Filament\Tables;

    class TagResource extends Resource
    {
        protected static ?string $model = Tag::class;

        protected static ?string $navigationIcon = 'heroicon-o-tag';

        protected static ?string $navigationGroup = 'Shop';

        protected static ?int $navigationSort = 4;

        public static function form ( Form $form )
        : Form {
            return $form
                ->schema([
                             TextInput::make('name'),
                         ])
            ;
        }

        public static function table ( Table $table )
        : Table {
            return $table
                ->columns([
                              Tables\Columns\TextColumn::make('name'),
                          ])
                ->filters([
                              //
                          ])
                ->actions([
                              Tables\Actions\EditAction::make(),
                          ])
                ->bulkActions([
                                  Tables\Actions\DeleteBulkAction::make(),
                              ])
            ;
        }

        public static function getRelations ()
        : array
        {
            return [
                //
            ];
        }

        public static function getPages ()
        : array
        {
            return [
                'index'  => Pages\ListTags::route('/'),
                'create' => Pages\CreateTag::route('/create'),
                'edit'   => Pages\EditTag::route('/{record}/edit'),
            ];
        }
    }
