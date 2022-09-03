<?php

    namespace App\Trait;

    trait RedirectAfterCreateEdit
    {
        protected function getRedirectUrl ()
        : string
        {
            return $this->getResource()::getUrl('index');
        }
    }
