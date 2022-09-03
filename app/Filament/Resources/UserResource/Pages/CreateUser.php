<?php

    namespace App\Filament\Resources\UserResource\Pages;

    use App\Filament\Resources\UserResource;
    use App\Trait\RedirectAfterCreateEdit;
    use Filament\Resources\Pages\CreateRecord;

    class CreateUser extends CreateRecord
    {
        use RedirectAfterCreateEdit;

        protected static string $resource = UserResource::class;
    }
