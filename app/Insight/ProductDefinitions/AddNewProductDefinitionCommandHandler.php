<?php namespace Insight\ProductDefinitions;
use Insight\Core\CommandBus;
use Insight\ProductDefinitions\Events\ProductDefinitionWasCreated;
use Insight\ProductDefinitions\Events\ProductDefinitionWasAssigned;
use Insight\Comments\AddNewCommentCommand;
use Insight\Companies\Company;
use Insight\Settings\Setting;

/**
 * Insight Client Management Portal:
 * Date: 11/7/14
 * Time: 2:17 PM
 */

class AddNewProductDefinitionCommandHandler extends ProductDefinitionCommandHandlerAbstract
{
    use CommandBus;

    protected $wasAssigned = false;

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
            // serialize the attributes in the input array
            if(isset($command->attributes))
                $command->attributes = json_encode($command->attributes);

            // determine the assigned user
            $command->assigned_user_id = (int)$this->setAssignedUser($command);

            //dd($command);
            // create the product request
            $product = $this->productDefinitionRepository->create($command);

            // add the history comment
            $comment = $this->execute(new AddNewCommentCommand(
                $product->id,
                get_class($product),
                $product->user_id,
                $this->compileComment($product, $command->status, $command->action)
            ));

            // process images and attachments
            $this->attachImages($product, [$command->image1, $command->image2, $command->image3, $command->image4]);
            $this->attachAttachments($product, $command->attachments);
        }
        catch (Exception $e)
        {
            return 'Could not create product.';
        }

        $product->raise(new ProductDefinitionWasCreated($product));
        if($this->wasAssigned)
            $product->raise(new ProductDefinitionWasAssigned($product, $command->remarks));

        $this->dispatchEventsFor($product);
    }

    /**
     * Determine who the request should be assigned to based on request status
     *
     * @param $command
     * @return mixed
     */
    protected function setAssignedUser($command)
    {
        switch ($command->status){
            case "1": // draft
                if($command->action === 'assign-to-customer')
                {
                    $this->wasAssigned = true;
                    return Company::find($command->company_id)->primaryContact->id;
                }
                elseif($command->action === 'assign-to-supplier')
                {
                    $this->wasAssigned = true;
                    return Company::find($command->supplier_id)->primaryContact->id;
                }
                return $command->user_id;

            case "2": // submitted
                $this->wasAssigned = true;
                return Setting::where('name', 'primary-cataloguer')->pluck('value');

            case "3": // processing
                $this->wasAssigned = true;
                return Setting::where('name', 'primary-provisioner')->pluck('value');

            default:
                return $command->user_id;
        }
    }

    protected function compileComment($product, $status, $action)
    {
        switch ($status){
            case "1": // submitted
                if($action === 'assign-to-customer')
                {
                    return 'Request created by ' . $product->createdBy->name() . ' and assigned to ' . $product->customer->primaryContact->name() . ' for input.';
                }
                elseif($action === 'assign-to-supplier')
                {
                    return 'Draft created by ' . $product->createdBy->name() . ' and assigned to supplier contact ' . $product->assignedTo->name() . ' for input.';
                }
                return 'Request draft created by ' . $product->createdBy->name() . '.';

            case "2": // processing
                return 'Request created by ' . $product->createdBy->name() . ' and submitted to ' . $product->assignedTo->name() . ' for review.';
            case "3":
                return 'Request created by ' . $product->createdBy->name() . ' and submitted to ' . $product->assignedTo->name() . ' for processing.';
            default:
                return 'Request created.';
        }
    }

    protected function wasAssignedBy()
    {

    }

    /**
     * Persist each images to DB product_images table
     *
     * @param $product
     * @param $images
     */
    protected function attachImages($product, Array $images)
    {
        foreach ($images as $image)
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
    }

//    protected function attachImage($product, $image)
//    {
//        if (! is_null($image))
//        {
//            ProductImage::create([
//                'imageable_id'      =>  $product->id,
//                'imageable_type'    =>  get_class($product),
//                'image'             =>  $image
//            ]);
//        }
//    }

    /**
     * Persist each attachment to DB product_attachments table
     *
     * @param $product
     * @param $attachments
     */
    protected function attachAttachments($product, $attachments)
    {
        foreach ($attachments as $attachment)
        {
            if (! is_null($attachment)) {
                ProductAttachment::create([
                    'attachable_id' => $product->id,
                    'attachable_type' => get_class($product),
                    'attachment' => $attachment
                ]);
            }
        }
    }
}