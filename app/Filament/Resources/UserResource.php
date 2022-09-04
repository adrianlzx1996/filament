<?php

    namespace App\Filament\Resources;

    use App\Filament\Resources\UserResource\Pages;
    use App\Filament\Resources\UserResource\RelationManagers;
    use App\Models\User;
    use Filament\Facades\Filament;
    use Filament\Forms\Components\TextInput;
    use Filament\Resources\Form;
    use Filament\Resources\Resource;
    use Filament\Resources\Table;
    use Filament\Tables;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Validation\Rules\Password;

    class UserResource extends Resource
    {
        protected static ?string $model = User::class;

        protected static ?string $navigationIcon = 'heroicon-o-user';

        protected static ?string $navigationGroup = 'Users';

        protected static ?int $navigationSort = 1;

        protected static ?string $recordTitleAttribute = 'name';

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
                              Tables\Actions\Action::make('changePassword')
                                                   ->form([
                                                              TextInput::make('new_password')
                                                                       ->password()
                                                                       ->label("New Password")
                                                                       ->required()
                                                                       ->rule(Password::default()),
                                                              TextInput::make('new_password_confirmation')
                                                                       ->password()
                                                                       ->label("Confirm New Password")
                                                                       ->same('new_password')
                                                                       ->required()
                                                                       ->rule(Password::default()),
                                                          ])
                                                   ->action(function ( User $record, array $data ) {
                                                       $record->update([
                                                                           'password' => Hash::make($data['new_password']),
                                                                       ]);

                                                       Filament::notify('success', 'Password updated successfully.');
                                                   }),
                          ])
                ->bulkActions([
//                                  Tables\Actions\DeleteBulkAction::make(),
                              ])
            ;
        }

        public static function form ( Form $form )
        : Form {
            return $form
                ->schema([
                             TextInput::make('name')
                                      ->autofocus()
                                      ->required(),
                             TextInput::make('email')
                                      ->email()
                                      ->required(),
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

        public static function getGloballySearchableAttributes ()
        : array
        {
            return [ 'name', 'email' ];
        }
    }
