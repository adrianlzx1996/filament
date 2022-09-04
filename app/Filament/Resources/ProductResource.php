<?php

    namespace App\Filament\Resources;

    use App\Filament\Resources\ProductResource\Pages;
    use App\Filament\Resources\ProductResource\RelationManagers;
    use App\Models\Product;
    use Closure;
    use Filament\Forms\Components\FileUpload;
    use Filament\Forms\Components\TextInput;
    use Filament\Resources\Form;
    use Filament\Resources\Resource;
    use Filament\Resources\Table;
    use Filament\Tables;
    use Illuminate\Support\Str;

    class ProductResource extends Resource
    {
        protected static ?string $model = Product::class;

        protected static ?string $navigationIcon = 'heroicon-o-collection';

        protected static ?string $navigationGroup = 'Shop';

        protected static ?string $recordTitleAttribute = 'name';

        public static function form ( Form $form )
        : Form {
            return $form
                ->schema([
                             TextInput::make('name')
                                      ->required()
                                      ->reactive()
                                      ->afterStateUpdated(function ( Closure $set, $state ) {
                                          $set('slug', Str::slug($state));
                                      }),
                             TextInput::make('slug')
                                      ->unique(ignoreRecord: true)
                                      ->required(),
                             TextInput::make('price')
                                      ->required()
                                      ->rule('numeric'),
                             FileUpload::make('image'),
                             //                             MultiSelect::make('tags')
                             //                                        ->relationship('tags', 'name'),
                         ])
            ;
        }

        public static function table ( Table $table )
        : Table {
            return $table
                ->columns([
                              Tables\Columns\ImageColumn::make('image')
                                                        ->width(50)
                                                        ->height(50),
                              Tables\Columns\TextColumn::make('name')
                                                       ->sortable()
                                                       ->searchable(),
                              Tables\Columns\TextColumn::make('price')
                                                       ->sortable()
                                                       ->money('myr'),
                          ])
                ->defaultSort('price', 'DESC')
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
                RelationManagers\TagsRelationManager::class,
            ];
        }

        public static function getPages ()
        : array
        {
            return [
                'index'  => Pages\ListProducts::route('/'),
                'create' => Pages\CreateProduct::route('/create'),
                'edit'   => Pages\EditProduct::route('/{record}/edit'),
            ];
        }

        protected static function getNavigationBadge ()
        : ?string
        {
            return self::getModel()::count();
        }
    }
