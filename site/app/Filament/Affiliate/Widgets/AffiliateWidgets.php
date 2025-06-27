<?php

namespace App\Filament\Affiliate\Widgets;

use App\Models\AffiliateHistory;
use App\Models\User;
use App\Models\Wallet;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Carbon\Carbon; // Carbon para manipulação de datas

class AffiliateWidgets extends BaseWidget
{
    use InteractsWithPageFilters;
    protected static ?int $navigationSort = -2;

    /**
     * @return array|Stat[]
     */
    protected function getCards(): array
    {
        $today = Carbon::today();
        $startDate = $this->filters['startDate'] ?? $today->copy()->subDays(30);
        $endDate = $this->filters['endDate'] ?? $today;

        $inviterId = auth()->user()->id;
        $usersIds = User::where('inviter', $inviterId)->get()->pluck('id');

        $query = AffiliateHistory::query()
            ->where('inviter', $inviterId)
            ->where('deposited_amount', '>', 0)
            ->whereBetween('created_at', [$startDate, $endDate]);

        $usersTotal = $query->count();

        $comissaoTotal = Wallet::whereIn('user_id', $usersIds)->sum('balance');
        $mycomission = Wallet::where('user_id', $inviterId)->sum('refer_rewards');

        return [
            Stat::make('Saldo Disponível', \Helper::amountFormatDecimal($mycomission))
                ->description('Saldo Disponível para saque')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Saldo dos indicados', \Helper::amountFormatDecimal($comissaoTotal))
                ->description('Saldo geral dos indicados.')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Cadastros', $usersTotal)
                ->description('Usuários cadastrados com meu link')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
        ];
    }

    /**
     * @return bool
     */
    public static function canView(): bool
    {
        return auth()->user()->hasRole('afiliado');
    }
}
