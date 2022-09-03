<?php

    namespace App\Filament\Resources\ProductResource\Pages;

    use App\Filament\Resources\ProductResource;
    use App\Trait\RedirectAfterCreateEdit;
    use Filament\Resources\Pages\CreateRecord;

    class CreateProduct extends CreateRecord
    {
        use RedirectAfterCreateEdit;

        protected static string $resource = ProductResource::class;

        protected function getRedirectUrl ()
        : string
        {
            return $this->getResource()::getUrl('index');
        }

        protected function mutateFormDataBeforeCreate ( array $data )
        : array {
            $data['price'] = $data['price'] * 100;
            return $data;
        }
    }
