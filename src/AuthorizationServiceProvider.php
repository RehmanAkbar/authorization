<?php

namespace Softpyramid\Authorization;

use App\Erp\Models\User;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AuthorizationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {

        $this->loadViewsFrom(__DIR__.'/views', 'authorization');

        $this->publishes([
            __DIR__.'/views' => resource_path('views/'),
        ]);

        $this->registerAllPermissions($gate);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
    protected function getPermissions() 
    {
        return ($this->app->make('App\Erp\Repositories\PermissionRepository')->withRoles());
    }
    private function isDBReady() 
    {
        $has_records = false;
        $tables_created = (Schema::hasTable('user_types') and Schema::hasTable('users') and Schema::hasTable('permissions') and Schema::hasTable('roles'));


        return $tables_created;
    }
    private function registerAllPermissions($gate)
    {

        /**
         * Dynamically register permissions with Laravel's Gate.
         **/
        if ($this->isDBReady()) //if the db is created and has the records
        {
            foreach ($this->getPermissions() as $permission) {

                $gate->define($permission->name, function ($user) use ($permission) {

                    return $user->hasPermission($permission);
                });

            }
        }
    }
}
