<?php namespace Insight\Mailers; 
/**
 * Insight Client Management Portal:
 * Date: 8/16/14
 * Time: 4:23 PM
 */

class PortalUpdatesMailer extends Mailer
{
    public function sendContractUpdatesMessageTo(Array $emailRecipients, $data = [])
    {
        $subject = $data['customer'] . ' Contracts Updated';
        $view = 'emails.changelog.contracts';

        foreach ($emailRecipients as $email)
        {
            $this->sendTo($email, $subject, $view, $data);
        }

    }

    public function sendProductUpdatesMessageTo(Array $emailRecipients, $data = [])
    {
        $subject = $data['customer'] . ' Products Updated';
        $view = 'emails.changelog.products';

        foreach ($emailRecipients as $email)
        {
            $this->sendTo($email, $subject, $view, $data);
        }
    }
} 