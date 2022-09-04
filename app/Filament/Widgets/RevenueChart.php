<?php

    namespace App\Filament\Widgets;

    use App\Models\Payment;
    use Carbon\Carbon;
    use Filament\Widgets\LineChartWidget;
    use Flowframe\Trend\Trend;
    use Flowframe\Trend\TrendValue;

    class RevenueChart extends LineChartWidget
    {
        protected static ?string   $heading    = 'Revenue Per Day';
        protected static ?int      $sort       = 3;
        protected int|string|array $columnSpan = 'full';

        protected function getData ()
        : array
        {
            $data = Trend::model(Payment::class)
                         ->between(
                             start: now()->subDays(10),
                             end:   now(),
                         )
                         ->perDay()
                         ->sum('total')
            ;

            return [
                'datasets' => [
                    [
                        'label' => 'Revenue',
                        'data'  => $data->map(fn ( TrendValue $value ) => $value->aggregate / 100),
                    ],
                ],
                'labels'   => $data->map(fn ( TrendValue $value ) => Carbon::make($value->date)->format('M d')),
            ];
        }
    }
