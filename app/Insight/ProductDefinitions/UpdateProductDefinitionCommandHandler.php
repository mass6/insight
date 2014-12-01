<?php namespace Insight\ProductDefinitions;
use Insight\Core\CommandBus;
use Insight\ProductDefinitions\Events\ProductDefinitionWasUpdated;
use Insight\ProductDefinitions\Events\ProductDefinitionWasAssigned;
use Insight\ProductDefinitions\Events\ProductDefinitionWasCompleted;
use Insight\Comments\AddNewCommentCommand;
use Insight\Companies\Company;
use Insight\Settings\Setting;

/**
 * Insight Client Management Portal:
 * Date: 11/7/14
 * Time: 2:17 PM
 */

class UpdateProductDefinitionCommandHandler extends ProductDefinitionCommandHandlerAbstract
{
    use CommandBus;

    protected $wasAssigned = false;
    protected $isCompleted = false;

    /**
     * Handle the command
     *
     * @param $command
     * @return mixed
     */
    public function handle($command)
    {
        // Create the Company
        try
        {

            // serialize the attributes input array
            if(isset($command->attributes))
                $command->attributes = json_encode($command->attributes);

            // determine the assigned user
            $command->assigned_user_id = (int)$this->setAssignedUser($command);

            // determine if the order was assigned to another user
            $this->wasAssigned = $this->userWasAssigned($command->action);

            $this->isCompleted = $command->action === 'complete' ? true : false;

            $product = $command->formType === 'full' ? $this->productDefinitionRepository->update($command) : $this->productDefinitionRepository->updateLimited($command);

            // add the history comment
            $comment = $this->execute(new AddNewCommentCommand(
                $product->id,
                get_class($product),
                $command->user->id,
                $this->compileComment($product, $command->action, $command->status) . ($command->remarks !== '' ? '||' . $command->remarks : '')
            ));

            //$this->attachImages($product, $command->images);
            $this->attachImage($product, $command->image1);
            $this->attachImage($product, $command->image2);
            $this->attachImage($product, $command->image3);
            $this->attachImage($product, $command->image4);

            $this->attachAttachments($product, $command->attachments);

        }
        catch (Exception $e)
        {
            return 'Could not update product.';
        }

        // Raise the relevant events
        if($this->isCompleted)
            $product->raise(new ProductDefinitionWasCompleted($product, $command->remarks));
        else if($this->wasAssigned)
            $product->raise(new ProductDefinitionWasAssigned($product, $command->remarks));
        else
            $product->raise(new ProductDefinitionWasUpdated($product));


        $this->dispatchEventsFor($product);

        return $product;
    }


    /**
     * Determine who the request should be assigned to based on request action
     *
     * @param $command
     * @return mixed
     */
    protected function setAssignedUser($command)//$status, $action, $user_id, $currentUserId)
    {
        switch ($command->action){
            case "save": // draft
                return $command->assigned_user_id;

            case "assign-to-customer":
                $this->wasAssigned = true;
                return Company::find($command->company_id)->primaryContact->id;

            case "assign-to-supplier":
                $this->wasAssigned = true;
                return Company::find($command->supplier_id)->primaryContact->id;

            case "submit":
                $this->wasAssigned = true;
                return Setting::where('name', 'primary-cataloguer')->pluck('value');

            case "process":
                $this->wasAssigned = true;
                return Setting::where('name', 'primary-provisioner')->pluck('value');

//            case "revert":
//                if($command->status === "1")
//                {
//                    $this->wasAssigned = true;
//                    return Company::find($command->company_id)->primaryContact->id;
//                }
//                $this->wasAssigned = true;
//                return Setting::where('name', 'primary-cataloguer')->pluck('value');

            case "complete":
                return $command->assigned_user_id;

            default:
                return $command->assigned_user_id;
        }
    }


    protected function compileComment($product, $action, $status)
    {
        switch ($action){
            case "save":
                return 'Request was updated by ' . $product->updatedBy->name() . '.';

            case "assign-to-customer":
                return 'Request assigned to ' . $product->assignedTo->name() . ' by ' . $product->assignedBy->name() . ' for input.';

            case "assign-to-supplier":
                return 'Request assigned to supplier contact ' . $product->assignedTo->name() . ' by ' . $product->assignedBy->name() . ' for input.';

//            case "revert":
//                if($status === 1)
//                {
//                    return 'Request was reassigned back to ' . $product->customer->primaryContact->name() . ' by ' . $product->assignedBy->name() . '.';
//                }
//                return 'Request was reassigned back to ' . $product->assignedTo->name() . ' by ' . $product->assignedBy->name() . '.';

            case "submit":
                return 'Request was submitted to ' . $product->assignedTo->name() . ' by ' . $product->assignedBy->name() . ' for review.';

            case "process":
                return 'Request was submitted to ' . $product->assignedTo->name() . ' by ' . $product->assignedBy->name() . ' for processing.';

            case "complete":
                return 'Request was completed by ' . $product->updatedBy->name() . '.';

            default:
                return 'Request was updated by ' . $product->updatedBy->name() . '.';
        }
    }

    protected function userWasAssigned($action)
    {
        switch ($action) {
            case 'revert':
                return true;
            case 'submit':
                return true;
            case 'process':
                return true;
            default:
                return false;
        }

    }


    protected function attachImage($product, $image)
    {
        if (! is_null($image))
        {
            ProductImage::create([
                'imageable_id'      =>  $product->id,
                'imageable_type'    =>  get_class($product),
                'image'             =>  $image
            ]);
        }
    }

    /**
     * Persist each images to DB product_images table
     *
     * @param $product
     * @param $images
     */
    protected function attachImages($product, $images)
    {
        if(is_array($images)){
            foreach ($images as $image)
            {
                if (! is_null($image) && ! empty($image))
                {
                    ProductImage::create([
                        'imageable_id'      =>  $product->id,
                        'imageable_type'    =>  get_class($product),
                        'image'             =>  $image
                    ]);
                }
            }
        }
    }

    /**
     * Persist each attachment to DB product_attachments table
     *
     * @param $product
     * @param $attachments
     */
    protected function attachAttachments($product, $attachments)
    {
        if(is_array($attachments)){
            foreach ($attachments as $attachment)
            {
                if (! is_null($attachment) && ! empty($attachments)) {
                    ProductAttachment::create([
                        'attachable_id' => $product->id,
                        'attachable_type' => get_class($product),
                        'attachment' => $attachment
                    ]);
                }
            }
        }
    }
}