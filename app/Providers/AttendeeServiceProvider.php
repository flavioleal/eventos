<?php namespace Talentos\Providers;

use Illuminate\Support\ServiceProvider;
use Talentos\Services\Attendee\CredentialService;

class AttendeeServiceProvider extends ServiceProvider
{
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
        $this->app->bind('Attendee', function() {
		    return new CredentialService();
		});
	}
}