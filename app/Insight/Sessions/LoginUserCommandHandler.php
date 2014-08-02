<?php namespace Insight\Sessions; 
/**
 * Insight Client Management Portal:
 * Date: 7/27/14
 * Time: 1:06 AM
 */

use Insight\Sessions\Events\UserLoggedIn;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use Cartalyst\Sentry\Facades\Laravel\Sentry;
use Laracasts\Commander\Events\EventGenerator;

class LoginUserCommandHandler implements CommandHandler
{

    use EventGenerator, DispatchableTrait;

    /**
     * Handle the command
     *
     * @param $command
     * @return mixed
     */
    public function handle($command)
    {
        $user = Sentry::authenticate($command->credentials, false);

        $user->raise(new UserLoggedIn($user));

        $this->dispatchEventsFor($user);

        return $user;
    }

}