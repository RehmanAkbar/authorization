<?php

namespace Softpyramid\Authorization;

use Illuminate\Support\ServiceProvider;

class AuthorizationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__.'/routes.php';  
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
        return ($this->app->make('Softpyramid\Authorization\Repositories\PermissionRepository')->withRoles());
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
