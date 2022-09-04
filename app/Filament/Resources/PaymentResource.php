<?php

    namespace App\Filament\Resources;

    use App\Filament\Resources\PaymentResource\Pages;
    use App\Filament\Resources\PaymentResource\RelationManagers;
    use App\Models\Payment;
    use Filament\Resources\Form;
    use Filament\Resources\Resource;
    use Filament\Resources\Table;
    use Filament\Tables\Columns\TextColumn;
    use Illuminate\Database\Eloquent\Model;

    class PaymentResource extends Resource
    {
        protected static ?string $model = Payment::class;

        protected static ?string $navigationIcon = 'heroicon-o-collection';

        public static function form ( Form $form )
        : Form {
            return $form
                ->schema([
                             //
                         ])
            ;
        }

        public static function table ( Table $table )
        : Table {
            return $table
                ->columns([
                              TextColumn::make('created_at')
                                        ->label('Payment Time'),
                              TextColumn::make('product.name'),
                              TextColumn::make('user.name')->label('User Name'),
                              TextColumn::make('user.email')->label('User Email'),
                              TextColumn::make('voucher.code'),
                              TextColumn::make('subtotal')->money('myr'),
                              TextColumn::make('taxes')->money('myr'),
                              TextColumn::make('total')->money('myr'),
                          ])
                ->filters([
                              //
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
                'index' => Pages\ListPayments::route('/'),
                //                'create' => Pages\CreatePayment::route('/create'),
                //                'edit'   => Pages\EditPayment::route('/{record}/edit'),
            ];
        }

        public static function canCreate ()
        : bool
        {
            return false;
        }

        public static function canDelete ( Model $record )
        : bool {
            return false;
        }

        public static function canDeleteAny ()
        : bool
        {
            return false;
        }
    }
