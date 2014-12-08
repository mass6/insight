<?php namespace Insight\ProductDefinitions;
use Insight\ProductDefinitions\Events\ProductDefinitionWasCreated;

/**
 * Insight Client Management Portal:
 * Date: 11/7/14
 * Time: 2:17 PM
 */

class UpdateLimitedProductDefinitionCommandHandler extends ProductDefinitionCommandHandlerAbstract
{

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
            //$command->price = priceToInteger($command->price);

            $product = $this->productDefinitionRepository->updateLimited($command);

            $this->attachImages($product, $command->images);
            $this->attachAttachments($product, $command->attachments);

            return $product;
        }
        catch (Exception $e)
        {
            return 'Could not update product.';
        }


//        $product->raise(new ProductDefinitionWasCreated($product));
//        $this->dispatchEventsFor($product);
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