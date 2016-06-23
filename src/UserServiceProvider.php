<?php

namespace WI\User;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class UserServiceProvider extends ServiceProvider
{
    
	
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    #protected $defer = true;
	
	/**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
		if (is_dir(base_path() . '/resources/views/admin/user')) {
			$this->loadViewsFrom(base_path() . '/resources/views/admin/dasboard', 'user');
		} else {
			$this->loadViewsFrom(__DIR__.'/views', 'user');
		}

		if (!$this->app->routesAreCached()) {
			$this->setupRoutes($this->app->router);
		}


		//config
	    //$this->publishes([
		//    __DIR__.'/config/user.php' => config_path('wi/user.php'),
	    //],'user-config');

		//user
	    $this->publishes([
		    __DIR__.'/views/admin' => base_path('resources/views/admin/user')
	    ],'user-view');

	    //auth
		$this->publishes([
			__DIR__.'/views/auth' => base_path('resources/views/auth'),
		],'user-auth');
    }
	
	/**
		 * Define the routes for the application.
		 *
		 * @param  \Illuminate\Routing\Router  $router
		 * @return void
		 */
		public function setupRoutes(Router $router)
		{
			$router->group([
				//'namespace' => 'WI\Dashboard',
				'namespace' => 'WI\User',	// Controllers Within The "WI\Dashboard" Namespace
				'as' => 'admin::',		// Route named "admin::
				//'prefix' => 'backStage',	// Matches The "/admin" URL
				'prefix' => config('wi.dashboard.admin_prefix'),
				'middleware' => ['web','auth']	// Use Auth Middleware
			],
				function($router)
				{
					require __DIR__.'/routes.php';
				}
			);


		}

    /**
     * Register the application services.
     * https://laracasts.com/discuss/channels/general-discussion/how-to-move-my-controllers-into-a-seperate-package-folder
     * @return void
     */
    public function register()
    {
	    //dc(config('wi.dashboard.admin_prefix'));
	    //Carbon::setLocale(config('app.locale'));
	    $this->app->make('WI\User\UserController');
	    $this->app->singleton('WI\User\Settings' ,function(){
		    //$user = User::find(3);
		    //\Auth::login($user);
		    return \Auth::user()->settings();
	    });
		//$this->app->register(Vendor\Package\Providers\RouteServiceProvider::class);
    }
}
