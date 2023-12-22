<?php

namespace App\Providers;

use App\Repository\Department\DepartmentRepository;
use App\Repository\Department\DepartmentRepositoryInterface;
use App\Repository\Employee\EmployeeRepository;
use App\Repository\Employee\EmployeeRepositoryInterface;
use App\Repository\Setting\settingRepository;
use App\Repository\Setting\SettingRepositoryInterface;
use App\Repository\View\ViewRepository;
use App\Repository\View\ViewRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ViewRepositoryInterface::class, ViewRepository::class);
        $this->app->bind(EmployeeRepositoryInterface::class, EmployeeRepository::class);
        $this->app->bind(DepartmentRepositoryInterface::class, DepartmentRepository::class);
        $this->app->bind(SettingRepositoryInterface::class, settingRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
