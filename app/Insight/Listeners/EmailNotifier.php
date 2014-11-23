<?php namespace Insight\Listeners;
use Insight\ProductDefinitions\Events\ProductDefinitionWasAssigned;
use Insight\Users\Events\UserWasCreated;
use Insight\Users\Events\UserWasUpdated;
use Log, Mail;
/**
 * Insight Client Management Portal:
 * Date: 8/2/14
 * Time: 12:34 PM
 */

class EmailNotifier extends EventListener
{

    public function whenUserWasCreated(UserWasCreated $event)
    {
        if ($event->user->send_email)
        {
            $data = array('user' => $event->user);
            $mail = Mail::send('emails.auth.welcome', $data, function($message) use ($data)
            {
                $message->to($data['user']['email'], $data['user']['first_name'] )->subject('Welcome to 36S Insight!');
            });
        }
    }

    public function whenUserWasUpdated(UserWasUpdated $event)
    {
        Log::info("User: {$event->user->first_name} was updated!");
        if ($event->user->send_email) {
            Log::info('..and needs to have his credentials emailed again to ' . $event->user->email);
        }
    }


} 