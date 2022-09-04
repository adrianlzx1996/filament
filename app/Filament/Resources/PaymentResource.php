<?php

    namespace App\Filament\Resources;

    use App\Filament\Resources\PaymentResource\Pages;
    use App\Filament\Resources\PaymentResource\RelationManagers;
    use App\Models\Payment;
    use Filament\Forms\Components\DatePicker;
    use Filament\Resources\Form;
    use Filament\Resources\Resource;
    use Filament\Resources\Table;
    use Filament\Tables\Columns\TextColumn;
    use Filament\Tables\Filters\Filter;
    use Illuminate\Database\Eloquent\Model;

    class PaymentResource extends Resource
    {
        protected static ?string $model = Payment::class;

        protected static ?string $navigationIcon = 'heroicon-o-collection';

        public static function table ( Table $table )
        : Table {
            return $table
                ->columns([
                              TextColumn::make('created_at')
                                        ->label('Payment Time')
                                        ->sortable(),
                              TextColumn::make('product.name'),
                              TextColumn::make('user.name')->label('User Name'),
                              TextColumn::make('user.email')->label('User Email'),
                              TextColumn::make('voucher.code'),
                              TextColumn::make('subtotal')->money('myr'),
                              TextColumn::make('taxes')->money('myr'),
                              TextColumn::make('total')->money('myr'),
                          ])
                ->defaultSort('created_at', 'desc')
                ->filters([
                              Filter::make('created_at')
                                    ->form([
                                               DatePicker::make('created_from'),
                                               DatePicker::make('created_to'),
                                           ]
                                    )
                                    ->query(function ( $query, array $data ) {
                                        $query
                                            ->when($data['created_from'], fn ( $query ) => $query->whereDate('created_at', '>=', $data['created_from']))
                                            ->when($data['created_to'], fn ( $query ) => $query->whereDate('created_at', '<=', $data['created_to']))
                                        ;
                                    }),

                          ])
            ;
        }

        public static function form ( Form $form )
        : Form {
            return $form
                ->schema([
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
