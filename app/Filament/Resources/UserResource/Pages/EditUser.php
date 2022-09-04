<?php

    namespace App\Filament\Resources\UserResource\Pages;

    use App\Filament\Resources\UserResource;
    use App\Trait\RedirectAfterCreateEdit;
    use Filament\Forms\Components\TextInput;
    use Filament\Pages\Actions;
    use Filament\Pages\Actions\Action;
    use Filament\Resources\Pages\EditRecord;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Validation\Rules\Password;

    class EditUser extends EditRecord
    {
        use RedirectAfterCreateEdit;

        protected static string $resource = UserResource::class;

        protected function getActions ()
        : array
        {
            return [
                Action::make('changePassword')
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
                      ->action(function ( array $data ) {
                          $this->record->update([
                                                    'password' => Hash::make($data['new_password']),
                                                ]);

                          $this->notify('success', 'Password updated successfully.');
                      }),
                Actions\DeleteAction::make(),
            ];
        }
    }
