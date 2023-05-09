<?php

namespace App\Filament\Resources\UserResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Illuminate\Foundation\Auth\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class UserStatsOverview extends BaseWidget
{
    public $name;
    protected static ?string $pollingInterval = '10s';
    protected function getCards(): array
    {
        $totalUsersCount = User::count();
        $estudiantesCount = $this->getUsersByRole('Estudiantes')->count();
        $adminCount = $this->getUsersByRole('admin')->count();
        $totalUsersCount = User::count();
        $estudiantesCount = $this->getUsersByRole('Estudiantes')->count();
        $adminCount = $this->getUsersByRole('admin')->count();

        $yesterdayTotalUsersCount = $this->getYesterdayUsersCount();
        $yesterdayEstudiantesCount = $this->getYesterdayUsersCount('Estudiantes');
        $yesterdayAdminCount = $this->getYesterdayUsersCount('admin');

        $totalUsersDescriptionIcon = $totalUsersCount > $yesterdayTotalUsersCount ? 'heroicon-s-trending-up' : 'heroicon-s-trending-down';
        $estudiantesDescriptionIcon = $estudiantesCount > $yesterdayEstudiantesCount ? 'heroicon-s-trending-up' : 'heroicon-s-trending-down';
        $adminDescriptionIcon = $adminCount > $yesterdayAdminCount ? 'heroicon-s-trending-up' : 'heroicon-s-trending-down';

        $totalUsersColor = $totalUsersCount > $yesterdayTotalUsersCount ? 'success' : 'danger';
        $estudiantesColor = $estudiantesCount > $yesterdayEstudiantesCount ? 'success' : 'danger';
        $adminColor = $adminCount > $yesterdayAdminCount ? 'success' : 'danger';
        $user = Auth::user();
        $this->name = $user->name;
        // return[];
        if ($user->name === 'Admin') {
            return [
                Card::make('Total usuarios', $totalUsersCount)
                    ->description($totalUsersCount)
                    ->descriptionIcon($totalUsersDescriptionIcon)
                    ->chart($this->getUsersByDayOfWeek())
                    ->color($totalUsersColor),

                Card::make('Estudiantes', $estudiantesCount)
                    ->description($estudiantesCount)
                    ->descriptionIcon($estudiantesDescriptionIcon)
                    ->chart($this->getUsersByDayOfWeek('Estudiantes'))
                    ->color($estudiantesColor),

                Card::make('Admin', $adminCount)
                    ->description($adminCount)
                    ->descriptionIcon($adminDescriptionIcon)
                    ->chart($this->getUsersByDayOfWeek('admin'))
                    ->color($adminColor),
            ];
        } else {
            return [
                Card::make('Estudiantes', $estudiantesCount)
                    ->description($estudiantesCount)
                    ->descriptionIcon($estudiantesDescriptionIcon)
                    ->chart($this->getUsersByDayOfWeek('Estudiantes'))
                    ->color($estudiantesColor)
                    ->extraAttributes([
                        'class' => 'custom-card font-bold text-2xl text-center',
                        'style' => 'text-align: center; margin: 2rem auto; width: 50%; font-size: 5rem;',
                        'wire:click' => '$emitUp("setStatusFilter", "Estudiantes")',
                    ]),
            ];
        };
    }
    protected function getYesterdayUsersCount($roleName = null)
    {
        $yesterday = now()->subDay()->format('Y-m-d');

        if ($roleName) {
            return Role::where('name', $roleName)
                ->withCount(['users' => function ($query) use ($yesterday) {
                    $query->whereDate('created_at', $yesterday);
                }])
                ->first()
                ->users_count;
        }

        return User::whereDate('created_at', $yesterday)->count();
    }

    protected function getUsersByRole(string $roleName)
    {
        return Role::where('name', $roleName)->first()->users();
    }

    protected function getUsersByDayOfWeek(string $roleName = null)
    {
        $query = User::query();

        if ($roleName) {
            $query = $this->getUsersByRole($roleName);
        }

        return $query->get()->groupBy(function ($user) {
            return $user->created_at->format('l');
        })->map(function ($grouped) {
            return $grouped->count();
        })->toArray();
    }
}
