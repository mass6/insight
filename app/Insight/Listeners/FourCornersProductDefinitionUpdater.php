<?php namespace Insight\Listeners; 
/**
 * Insight Client Management Portal:
 * Date: 7/26/14
 * Time: 8:11 PM
 */
use Insight\ProductDefinitions\Events\ProductDefinitionWasCreated;
use Insight\ProductDefinitions\ProductDefinitionRepository;
use Log;

class FourCornersProductDefinitionUpdater extends EventListener {

    /**
     * @var ProductDefinitionRepository
     */
    private $productDefinitionRepository;

    public function __construct(ProductDefinitionRepository $productDefinitionRepository)
    {
        $this->productDefinitionRepository = $productDefinitionRepository;
    }

    public function whenProductDefinitionWasCreated(ProductDefinitionWasCreated $event)
    {
        $product = $event->productDefinition;

        if ($product->customer->name === 'FourC')
        {
            // retrieve product attributes and convert to normal array
            $attributes = object_to_array(json_decode($product->attributes));

            // set the Packaging variable to be the same as the UOM
            $attributes['Packaging'] = $product->uom;

            // convert array back to json and persist to DB
            $this->productDefinitionRepository->updateAttributes($product->id, json_encode($attributes));
        }


    }

} 