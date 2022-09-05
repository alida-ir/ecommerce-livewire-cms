<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
         'App\Models\User' => 'App\Policies\UserPolicy',
         'App\Models\Role' => 'App\Policies\RolePolicy',
         'App\Models\Permission' => 'App\Policies\PermissionPolicy',
         'App\Models\Product' => 'App\Policies\ProductPolicy',
         'App\Models\Category' => 'App\Policies\CategoryPolicy',
         'App\Models\Brand' => 'App\Policies\BrandPolicy',
         'App\Models\Discount' => 'App\Policies\DiscountPolicy',
         'App\Models\Warehouse' => 'App\Policies\WarehousePolicy',
         'App\Models\Setting' => 'App\Policies\SettingPolicy',
         'App\Models\Order' => 'App\Policies\OrderPolicy',
         'App\Models\TransAction' => 'App\Policies\TransActionPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
