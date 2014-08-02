<?php namespace Insight\Users;
use Insight\Users\Events\ProfileWasCreated;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

/**
 * Insight Client Management Portal:
 * Date: 7/29/14
 * Time: 5:05 PM
 */

class CreateUserProfileCommandHandler implements CommandHandler
{
    use DispatchableTrait;

    /**
     * Handle the command
     *
     * @param $command
     * @return mixed
     */
    public function handle($command)
    {
        $user = $command->user;
        $user->profile()->save(new Profile);

        $user->raise(new ProfileWasCreated($user));
        $this->dispatchEventsFor($user);
    }
}