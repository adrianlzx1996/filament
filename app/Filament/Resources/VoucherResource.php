<?php

    namespace App\Filament\Resources;

    use App\Filament\Resources\VoucherResource\Pages;
    use App\Filament\Resources\VoucherResource\RelationManagers;
    use App\Models\Voucher;
    use Filament\Forms\Components\Select;
    use Filament\Forms\Components\TextInput;
    use Filament\Resources\Form;
    use Filament\Resources\Resource;
    use Filament\Resources\Table;
    use Filament\Tables;

    class VoucherResource extends Resource
    {
        protected static ?string $model = Voucher::class;

        protected static ?string $navigationIcon = 'heroicon-o-collection';

        public static function form ( Form $form )
        : Form {
            return $form
                ->schema([
                             TextInput::make('code')
                                      ->required(),
                             TextInput::make('discount_percent')
                                      ->label('Discount (%)')
                                      ->required()
                                      ->rule('numeric'),
                             Select::make('product_id')
                                   ->relationship('product', 'name'),
                         ])
            ;
        }

        public static function table ( Table $table )
        : Table {
            return $table
                ->columns([
                              Tables\Columns\TextColumn::make('code'),
                              Tables\Columns\TextColumn::make('discount_percent')
                                                       ->label('Discount (%)'),
                              Tables\Columns\TextColumn::make('product.name'),
                          ])
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
                'index'  => Pages\ListVouchers::route('/'),
                'create' => Pages\CreateVoucher::route('/create'),
                'edit'   => Pages\EditVoucher::route('/{record}/edit'),
            ];
        }
    }
