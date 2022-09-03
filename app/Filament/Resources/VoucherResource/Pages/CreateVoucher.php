<?php

    namespace App\Filament\Resources\VoucherResource\Pages;

    use App\Filament\Resources\VoucherResource;
    use App\Trait\RedirectAfterCreateEdit;
    use Filament\Resources\Pages\CreateRecord;

    class CreateVoucher extends CreateRecord
    {
        use RedirectAfterCreateEdit;

        protected static string $resource = VoucherResource::class;

    }
