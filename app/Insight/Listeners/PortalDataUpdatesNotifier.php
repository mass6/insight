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
use Insight\Settings\SettingRepository;
use Illuminate\Support\Facades\Config;

/**
 * Class PortalDataUpdatesNotifier
 * @package Insight\Listeners
 */
class PortalDataUpdatesNotifier extends EventListener
{
    /**
     * @var \Insight\Mailers\VerificationMailer
     */
    private $mailer;

    /**
     * @var SettingRepository
     */
    protected $setting;

    protected $sendNotifications;

    /**
     * @param PortalUpdatesMailer $mailer
     * @param SettingRepository $setting
     */
    public function __construct(PortalUpdatesMailer $mailer, SettingRepository $setting)
    {
        $this->mailer = $mailer;
        $this->setting = $setting;
        $this->sendNotifications = $this->notificationsAreEnabled();
    }

    private function notificationsAreEnabled()
    {
        return $this->setting->findByName('portal-data-update-notifications');
    }


    /**
     * @param ContractsWereUpdated $event
     */
    public function whenContractsWereUpdated(ContractsWereUpdated $event)
    {
        $log = $event->changeLog;

        foreach ($log as $customer => $contractUpdates)
        {
            $data = ['customer' => Config::get('insight.customers')[strtolower($customer)]['displayName'], 'data' => $contractUpdates];
            $emailRecipients = $this->getEmailRecipients('ContractsUpdated', $customer);

            if ($this->sendNotifications && $emailRecipients)
            {
                $this->mailer->sendContractUpdatesMessageTo($emailRecipients, $data);
            }

        }

    }

    /**
     * @param ProductsWereUpdated $event
     */
    public function whenProductsWereUpdated(ProductsWereUpdated $event)
    {
        $log = $event->changeLog;

        foreach ($log as $customer => $productUpdates)
        {
            $data = ['customer' => Config::get('insight.customers')[strtolower($customer)]['displayName'], 'data' => $productUpdates];
            $emailRecipients = $this->getEmailRecipients('ProductsUpdated', $customer);

            if ($this->sendNotifications && $emailRecipients)
            {
                $this->mailer->sendProductUpdatesMessageTo($emailRecipients, $data);
            }

        }

    }

    /**
     * @param $notification
     * @param null $customer
     * @return array
     */
    private function getEmailRecipients($notification, $customer = null)
    {
        // General recipients
        $generalNotification = Notification::where('name', $notification)->first();
        $emailRecipients = $generalNotification->users->lists('email');


        // Customer specific recipients
        if (isset($customer))
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