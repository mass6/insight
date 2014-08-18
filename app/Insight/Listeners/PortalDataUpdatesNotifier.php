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

        $notification = Notification::where('name', 'ContractsUpdated')->first();
        $emailRecipients = $notification->users->lists('email');

        $notification = Notification::where('name', 'EmrillContractsUpdated')->first();
        $emails = $notification->users->lists('email');
        $emrillEmailRecipients = array_unique(array_merge($emailRecipients, $emails));


        foreach ($log as $customer => $contractUpdates)
        {
            $data = ['customer' => $customer, 'data' => $contractUpdates];

            $this->mailer->sendContractUpdatesMessageTo($customer = 'Emrill' ? $emrillEmailRecipients : $emailRecipients, $data);

        }

    }

    public function whenProductsWereUpdated(ProductsWereUpdated $event)
    {
        $log = $event->changeLog;

        $notification = Notification::where('name', 'ProductsUpdated')->first();
        $emailRecipients = $notification->users->lists('email');

        $notification = Notification::where('name', 'EmrillProductsUpdated')->first();
        $emails = $notification->users->lists('email');

        $emrillEmailRecipients = array_unique(array_merge($emailRecipients, $emails));

        foreach ($log as $customer => $productUpdates)
        {
            $data = ['customer' => $customer, 'data' => $productUpdates];

            $this->mailer->sendProductUpdatesMessageTo($customer = 'Emrill' ? $emrillEmailRecipients : $emailRecipients, $data);

        }

    }
} 