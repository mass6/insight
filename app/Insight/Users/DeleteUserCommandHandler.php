<?php namespace Insight\Users;
use Insight\Users\Events\UserDeleted;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

/**
 * Insight Client Management Portal:
 * Date: 7/29/14
 * Time: 3:41 PM
 */

class DeleteUserCommandHandler implements  CommandHandler
{
    use DispatchableTrait;
    /**
     * @var UserRepository
     */
    protected $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    /**
     * Handle the command
     *
     * @param $command
     * @return mixed
     */
    public function handle($command)
    {
        $savedUser = clone $command->user;

        $this->user->delete($command->user->id);

        $savedUser->raise(new UserDeleted($savedUser));

        $this->dispatchEventsFor($savedUser);
    }
}