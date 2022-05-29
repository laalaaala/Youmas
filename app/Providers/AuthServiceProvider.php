<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\Business\BusinessSubscriptionsPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        User::class => UserPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('update-user', [UserPolicy::class, 'update']);

        /**
         * Business
         */
        Gate::define('create-stripe-customer', [BusinessSubscriptionsPolicy::class, 'createCustomer']);
        Gate::define('update', [BusinessSubscriptionsPolicy::class, 'update']);
    }
}
