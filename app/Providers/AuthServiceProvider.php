<?php

namespace App\Providers;

use App\Announcement;
use App\Budget;
use App\Club;
use App\Department;
use App\Employee;
use App\Event;
use App\Policies\AnnouncementPolicy;
use App\Policies\BudgetPolicy;
use App\Policies\ClubPolicy;
use App\Policies\DepartmentPolicy;
use App\Policies\EmployeePolicy;
use App\Policies\EventPolicy;
use App\Policies\PositionPolicy;
use App\Policies\UserPolicy;
use App\Position;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        Department::class => DepartmentPolicy::class,
        Position::class => PositionPolicy::class,
        Employee::class => EmployeePolicy::class,
        Club::class => ClubPolicy::class,
        Announcement::class => AnnouncementPolicy::class,
        Event::class => EventPolicy::class,
        User::class => UserPolicy::class,
        Budget::class => BudgetPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();
    }
}
