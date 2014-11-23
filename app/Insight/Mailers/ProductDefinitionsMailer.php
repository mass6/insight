<?php namespace Insight\Mailers; 
/**
 * Insight Client Management Portal:
 * Date: 8/16/14
 * Time: 4:23 PM
 */

class ProductDefinitionsMailer extends Mailer
{
    public function sendRequestWasAssignedTo($emailRecipient, $data = [])
    {
        $subject = 'Cataloguing request assigned: '  . $data['product']->code;
        $view = 'emails.product-definitions.assigned';

        $this->sendTo($emailRecipient, $subject, $view, $data);

    }
    public function sendRequestWasCompletedTo(Array $emailRecipients, $data = [])
    {
        $subject = 'Cataloguing request completed: '  . $data['product']->code;
        $view = 'emails.product-definitions.completed';

        foreach ($emailRecipients as $email)
        {
            $this->sendTo($email, $subject, $view, $data);
        }

    }



//    public function sendProductUpdatesMessageTo(Array $emailRecipients, $data = [])
//    {
//        $subject = $data['customer'] . ' Products Updated';
//        $view = 'emails.changelog.products';
//
//        foreach ($emailRecipients as $email)
//        {
//            $this->sendTo($email, $subject, $view, $data);
//        }
//    }
} 