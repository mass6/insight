<?php namespace Insight\Listeners; 
/**
 * Insight Client Management Portal:
 * Date: 7/26/14
 * Time: 8:11 PM
 */

use Insight\Sessions\Events\UserLoggedIn;
use Insight\Users\Events\UserWasUpdated;
use Log;

class ActivityLogger extends EventListener {

    public function whenUserLoggedIn(UserLoggedIn $event)
    {
        Log::info('User has logged in: ' . $event->user->first_name . $event->user->last_name . ' | ' . $event->user->email);
    }

    public function whenUserWasUpdated(UserWasUpdated $event)
    {
        Log::info($event->user->first_name . ' was updated and logged.');
    }
} 