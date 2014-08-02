<?php namespace Insight\Users;
use Aws\CloudFront\Exception\Exception;
use Insight\Users\Events\ProfileWasUpdated;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

/**
 * Insight Client Management Portal:
 * Date: 7/29/14
 * Time: 8:14 PM
 */

class UpdateProfileCommandHandler implements CommandHandler
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
        try
        {
            $profile = $command->user->profile;
            $profile->fill($command->data);
            $profile->save();
        }
        catch (Exception $e)
        {
            return $e->getMessage();
        }

        $command->user->raise(new ProfileWasUpdated($command->user));
        $this->dispatchEventsFor($command->user);

        return $profile;
    }
}