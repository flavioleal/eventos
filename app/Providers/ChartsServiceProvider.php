<?php namespace Talentos\Providers;

use Illuminate\Support\ServiceProvider;
use Talentos\Services\Charts;

class ChartsServiceProvider extends ServiceProvider {

	/**
	 * Overwrite any vendor / package configuration.
	 *
	 * This service provider is intended to provide a convenient location for you
	 * to overwrite any "vendor" or package configuration that you may want to
	 * modify before the application handles the incoming request / command.
	 *
	 * @return void
	 */

	public function register()
	{
		#parent::register();

        $this->app->bind('Charts', function()
		{
		    return new \Talentos\Services\Charts;
		});
	}

}
