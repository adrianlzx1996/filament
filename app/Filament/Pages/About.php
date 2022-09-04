<?php

    namespace App\Filament\Pages;

    use App\Models\Product;
    use Filament\Pages\Page;

    class About extends Page
    {
        protected static ?string $navigationIcon = 'heroicon-o-document-text';

        protected static string $view = 'filament.pages.about';

        public $content;

        public function mount ()
        {
            $this->content = Product::all();
        }
    }
