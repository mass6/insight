<?php namespace Insight\Listeners; 
/**
 * Insight Client Management Portal:
 * Date: 8/16/14
 * Time: 4:50 PM
 */
use Insight\Mailers\ProductDefinitionsMailer;
use Insight\Portal\Contracts\Events\ContractsWereUpdated;
use Insight\Portal\Products\Events\ProductsWereUpdated;
use Insight\Notifications\Notification;
use Insight\Mailers\PortalUpdatesMailer;
use Insight\ProductDefinitions\Events\ProductDefinitionWasAssigned;
use Insight\ProductDefinitions\Events\ProductDefinitionWasCompleted;
use Insight\Settings\SettingRepository;
use Illuminate\Support\Facades\Config;


class ProductDefinitionsNotifier extends EventListener
{
    /**
     * @var \Insight\Mailers\VerificationMailer
     */
    private $mailer;



    /**
     * @param ProductDefinitionsMailer $mailer
     */
    public function __construct(ProductDefinitionsMailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function whenProductDefinitionWasAssigned(ProductDefinitionWasAssigned $event)
    {
        $product = $event->productDefinition;
        $emailRecipient = $product->assignedTo->email;
        $assignedUser = $product->assignedTo->name();
        $assignedBy = $product->assignedBy->name();
        $assignedByCompany = $product->assignedBy->company->name;
        $customerName = $product->customer->name;
        $remarks = $event->remarks;

        $data = [
            'product' => $product,
            'assignedUser' => $assignedUser,
            'assignedBy' => $assignedBy,
            'assignedByCompany' => $assignedByCompany,
            'customerName' => $customerName,
            'remarks'   => $remarks
        ];

        $this->mailer->sendRequestWasAssignedTo($emailRecipient, $data);

    }

    public function whenProductDefinitionWasCompleted(ProductDefinitionWasCompleted $event)
    {
        $product = $event->productDefinition;
        $emailRecipients[] = $product->createdBy->email;
        $emailRecipients[] = $product->cataloguer()->email;
        $updatedBy = $product->updatedBy->name();
        $customerName = $product->customer->name;
        $remarks = $event->remarks;


        $data = [
            'product' => $product,
            'updatedBy' => $updatedBy,
            'customerName' => $customerName,
            'remarks'   => $remarks
        ];

        $this->mailer->sendRequestWasCompletedTo(array_unique($emailRecipients), $data);

    }

    /**
     * @param ContractsWereUpdated $event
     */
    public function whenContractsWereUpdatedSample(ContractsWereUpdated $event)
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
    public function whenProductsWereUpdatedSample(ProductsWereUpdated $event)
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