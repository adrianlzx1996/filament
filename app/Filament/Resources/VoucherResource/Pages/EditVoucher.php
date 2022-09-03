<?php

    namespace App\Filament\Resources\VoucherResource\Pages;

    use App\Filament\Resources\VoucherResource;
    use App\Trait\RedirectAfterCreateEdit;
    use Filament\Pages\Actions;
    use Filament\Resources\Pages\EditRecord;

    class EditVoucher extends EditRecord
    {
        use RedirectAfterCreateEdit;
    
        protected static string $resource = VoucherResource::class;

        protected function getActions ()
        : array
        {
            return [
                Actions\DeleteAction::make(),
            ];
        }
    }
