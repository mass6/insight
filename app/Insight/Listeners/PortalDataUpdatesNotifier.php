<?php namespace Insight\Listeners; 
/**
 * Insight Client Management Portal:
 * Date: 8/16/14
 * Time: 4:50 PM
 */
use Insight\Portal\Contracts\Events\ContractsWereUpdated;
use Insight\Portal\Products\Events\ProductsWereUpdated;
use Insight\Notifications\Notification;
use Insight\Mailers\PortalUpdatesMailer;

class PortalDataUpdatesNotifier extends EventListener
{
    /**
     * @var \Insight\Mailers\VerificationMailer
     */
    private $mailer;

    public function __construct(PortalUpdatesMailer $mailer)
    {
        $this->mailer = $mailer;
    }



    public function whenContractsWereUpdated(ContractsWereUpdated $event)
    {
        $log = $event->changeLog;

        foreach ($log as $customer => $contractUpdates)
        {
            $data = ['customer' => $customer, 'data' => $contractUpdates];

            $this->mailer->sendContractUpdatesMessageTo($this->getEmailRecipients('ContractsUpdated', $customer), $data);

        }

    }

    public function whenProductsWereUpdated(ProductsWereUpdated $event)
    {
        $log = $event->changeLog;

        foreach ($log as $customer => $productUpdates)
        {
            $data = ['customer' => $customer, 'data' => $productUpdates];

            $this->mailer->sendProductUpdatesMessageTo($this->getEmailRecipients('ProductsUpdated', $customer), $data);

        }

    }

    private function getEmailRecipients($notification, $customer = null)
    {
        // General recipients
        $generalNotification = Notification::where('name', $notification)->first();
        $emailRecipients = $generalNotification->users->lists('email');


        // Customer specific recipients
        if ($customer)
        {
            $notificationName = $customer . $notification;
            $customerNotification = Notification::where('name', $notificationName)->first();


            if ($customerNotification)
            {
                $emails = $customerNotification->users->lists('email');
                return array_unique(array_merge($emailRecipients, $emails));
            }

        }
        else return $emailRecipients;


    }
}