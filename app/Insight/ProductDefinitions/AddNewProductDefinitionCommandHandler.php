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

            // determine the status
            $command->status = $this->setStatus($command->action);

            // persist the new request
            $product = $this->productDefinitionRepository->create($command);

            // assign the request to designated user
            $product->assigned_user_id = (int)$this->setAssignedUser($command);
            $product->save();

            // add the history comment
            $comment = $this->execute(new AddNewCommentCommand(
                $product->id,
                get_class($product),
                $product->user_id,
                $this->compileComment($product, $command->action)
            ));

            // save the attached images
            //$this->attachImages($product, [$command->image1, $command->image2, $command->image3, $command->image4]);

            // save the attached file attachments
            //$this->attachAttachments($product, $command->attachments);


            //dd($command);

//            if(!isset($command->attributes) && (int)$command->company_id === 2)
//            {
//                $command->attributes = '{"Brand":"","HS Code":"","Barcode Number":"","Country of Manufacture":"","Lead Time":"","Ingredients":"","Calories":"","Calories From Fat":"","Total Fat":"","Saturated Fat":"","Trans Fat":"","Cholesterol":"","Sodium":"","Total Carbohydrates":"","Dietary Fiber":"","Sugars":"","Protein":"","Vitamin A":"","Vitamin C":"","Calcium":"","Iron":"","Packaging":"","Packaging Type":"","Shelf Life":"","Storage Condition":"","Weight Case Net":"","Weight Case Gross":"","Weight Individual Net":"","Weight Individual Gross":"","Weight Individual Drain":""}';
//            }



            //dd($command);
            // create the product request
            //$product = $this->productDefinitionRepository->create($command);

            // add the history comment


            // process images and attachments

        }
        catch (Exception $e)
        {
            return 'Could not create product.';
        }

        // raise and dispatch the events
        $product->raise(new ProductDefinitionWasCreated($product));
        if($this->wasAssigned)
            $product->raise(new ProductDefinitionWasAssigned($product, $command->remarks));

        $this->dispatchEventsFor($product);
    }

    protected function setStatus($action)
    {
        switch ($action){
            case "save":
            case "assign-to-customer":
            case "assign-to-supplier":
                return 1; // draft
            case "submit":
                return 2; // submitted
            case "process":
                return 3; // processing

        }
    }

    /**
     * Determine who the request should be assigned to based on request status
     *
     * @param $command
     * @return mixed
     */
    protected function setAssignedUser($command)
    {
        switch ($command->action){
            case "assign-to-customer":
                $this->wasAssigned = true;
                return Company::find($command->company_id)->primaryContact->id;

            case "assign-to-supplier":
                $this->wasAssigned = true;
                return Company::find($command->supplier_id)->primaryContact->id;

            case "submit": // submitted
                $this->wasAssigned = true;
                return Setting::where('name', 'primary-cataloguer')->pluck('value');

            case "process": // processing
                $this->wasAssigned = true;
                return Setting::where('name', 'primary-provisioner')->pluck('value');

            default:
                return $command->user->id;
        }
    }

    protected function compileComment($product, $action)
    {
        switch ($action){
            case "save":
                return 'Request draft created by ' . $product->createdBy->name() . '.';
            case "assign-to-customer":
                return 'Request created by ' . $product->createdBy->name() . ' and assigned to ' . $product->customer->primaryContact->name() . ' for input.';
            case "assign-to-supplier":
                 return 'Request created by ' . $product->createdBy->name() . ' and assigned to supplier contact ' . $product->assignedTo->name() . ' for input.';
            case "submit":
                return 'Request created by ' . $product->createdBy->name() . ' and submitted to ' . $product->assignedTo->name() . ' for review.';
            case "process":
                return 'Request created by ' . $product->createdBy->name() . ' and submitted to ' . $product->assignedTo->name() . ' for processing.';
            default:
                return 'Request created.';
        }
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