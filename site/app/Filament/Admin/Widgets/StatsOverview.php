<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 2;

    protected static ?string $pollingInterval = '15s';

    protected static bool $isLazy = true;

    /**
     * @return array|Stat[]
     */
    protected function getStats(): array
    {
        $sevenDaysAgo = Carbon::now()->subDays(7);

        $totalApostas = Order::whereIn('type', ['bet', 'loss'])->sum('amount');
        $totalWins = Order::where('type', 'win')->sum('amount');

        $totalWonLast7Days = $totalWins;
        $totalLoseLast7Days = $totalApostas;

        return [
            Stat::make('Total Usuários', User::count())
                ->description('Novos usuários')
                ->descriptionIcon('heroicon-m-arrow-up')
                ->color('info')
                ->extraAttributes([
                'style' => 'background: #0D0D0D;
                ',
            ])  ,
            Stat::make('Total Ganhos', \Helper::amountFormatDecimal($totalWonLast7Days))
                ->description('Ganhos dos usuários')
                ->descriptionIcon('heroicon-m-arrow-up')
                ->color('success')
                ->extraAttributes([
                    'style' => 'background: #0D0D0D;
                    ',
                ]),
            Stat::make('Total Perdas', \Helper::amountFormatDecimal($totalLoseLast7Days))
                ->description('Perdas dos usuários')
                ->descriptionIcon('heroicon-m-arrow-down')
                ->color('danger')
                                ->extraAttributes([
                'style' => 'background: #0D0D0D;
                ',
            ])
                
        ];
    }

    /**
     * @return bool
     */
    public static function canView(): bool
    {
        return auth()->user()->hasRole('admin');
    }
}
