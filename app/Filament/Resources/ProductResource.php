<?php

    namespace App\Filament\Resources;

    use App\Filament\Resources\ProductResource\Pages;
    use App\Filament\Resources\ProductResource\RelationManagers;
    use App\Models\Product;
    use Filament\Forms\Components\TextInput;
    use Filament\Resources\Form;
    use Filament\Resources\Resource;
    use Filament\Resources\Table;
    use Filament\Tables;

    class ProductResource extends Resource
    {
        protected static ?string $model = Product::class;

        protected static ?string $navigationIcon = 'heroicon-o-collection';

        public static function form ( Form $form )
        : Form {
            return $form
                ->schema([
                             TextInput::make('name')
                                      ->required(),
                             TextInput::make('price')
                                      ->required(),
                         ])
            ;
        }

        public static function table ( Table $table )
        : Table {
            return $table
                ->columns([
                              Tables\Columns\TextColumn::make('name')
                                                       ->sortable()
                                                       ->searchable(),
                              Tables\Columns\TextColumn::make('price')
                                                       ->sortable(),
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
                //
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
    }
