<?php namespace Talentos\Handlers\Events;

//use Talentos\Events\

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Talentos\User;
use DateTime;

class AuthLoginEventHandler {

	/**
	 * Create the event handler.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Handle the event.
	 *
	 * @param  Events  $event
	 * @return void
	 */
	public function handle(User $user, $remember)
	{
		$user->last_login = new DateTime;
    	$user->save();
	}

}
