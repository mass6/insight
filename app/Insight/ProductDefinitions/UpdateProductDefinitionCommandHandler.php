<?php namespace Insight\ProductDefinitions;
use Insight\Core\CommandBus;
use Insight\ProductDefinitions\Events\ProductDefinitionWasUpdated;
use Insight\ProductDefinitions\Events\ProductDefinitionWasAssigned;
use Insight\ProductDefinitions\Events\ProductDefinitionWasCompleted;
use Insight\Comments\AddNewCommentCommand;

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
            $command->assigned_user_id = (int)$this->assignUserByStatusAndAction($command->status, $command->action, $command->user_id, $command->current_user_id);

            // determine if the order was assigned to another user
            $this->wasAssigned = $this->userWasAssigned($command->action);

            $this->isCompleted = $command->action === 'complete' ? true : false;

            $product = $this->productDefinitionRepository->update($command);

            // add the history comment
            $comment = $this->execute(new AddNewCommentCommand(
                $product->id,
                get_class($product),
                $command->user->id,
                $this->compileComment($product, $command->action) . ($command->remarks !== '' ? '||' . $command->remarks : '')
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
     * Determine who the request should be assigned to based on request status
     *
     * @param $status
     * @param $action
     * @param $user_id
     * @param $currentUserId
     * @return mixed
     */
    protected function assignUserByStatusAndAction($status, $action, $user_id, $currentUserId)
    {
        switch ($status){
            case "1": // draft
                return $action === 'revert' ? $user_id : $currentUserId;
            case "2": // submitted
                return Setting::where('name', 'primary-cataloguer')->pluck('value');
            case "3": // processing
                return Setting::where('name', 'primary-provisioner')->pluck('value');
            default:
                return $currentUserId;
        }
    }

    protected function compileComment($product, $action)
    {
        switch ($action){
            case "revert":
                return 'Request was reassigned back to ' . $product->createdBy->name() . ' by ' . $product->assignedBy->name() . '.';
            case "save":
                return 'Request was updated by ' . $product->updatedBy->name() . '.';
            case "submit":
                return 'Request was submitted to ' . $product->assignedTo->name() . ' for review.';
            case "process":
                return 'Request was submitted to ' . $product->assignedTo->name() . ' for proccessing.';
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