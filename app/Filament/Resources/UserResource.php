<?php

    namespace App\Filament\Resources;

    use App\Filament\Resources\UserResource\Pages;
    use App\Filament\Resources\UserResource\RelationManagers;
    use App\Models\User;
    use Filament\Resources\Form;
    use Filament\Resources\Resource;
    use Filament\Resources\Table;
    use Filament\Tables;
    use Illuminate\Database\Eloquent\Model;

    class UserResource extends Resource
    {
        protected static ?string $model = User::class;

        protected static ?string $navigationIcon = 'heroicon-o-collection';

        public static function form ( Form $form )
        : Form {
            return $form
                ->schema([
                             //
                         ])
            ;
        }

        public static function table ( Table $table )
        : Table {
            return $table
                ->columns([
                              Tables\Columns\TextColumn::make('id')->label('ID')->sortable(),
                              Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                              Tables\Columns\TextColumn::make('email')->searchable()->sortable(),
                              Tables\Columns\TextColumn::make('created_at')->date('d/M/y h:i a')->sortable(),
                          ])
                ->defaultSort('id', 'desc')
                ->filters([
                              //
                          ])
                ->actions([
                              Tables\Actions\EditAction::make(),
                          ])
                ->bulkActions([
//                                  Tables\Actions\DeleteBulkAction::make(),
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
                'index' => Pages\ListUsers::route('/'),
                //                'create' => Pages\CreateUser::route('/create'),
                'edit'  => Pages\EditUser::route('/{record}/edit'),
            ];
        }

        public static function canCreate ()
        : bool
        {
            return false;
        }

        public static function canDelete ( Model $record )
        : bool {
            return false;
        }

        public static function canDeleteAny ()
        : bool
        {
            return false;
        }
    }
