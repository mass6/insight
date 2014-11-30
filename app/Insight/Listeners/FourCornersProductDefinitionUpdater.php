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
        if(!$product->attributes && $product->customer->name === '4 Corners')
        {
            $attributes = '{"Brand":"","HS Code":"","Barcode Number":"","Country of Manufacture":"","Lead Time":"","Ingredients":"","Calories":"","Calories From Fat":"","Total Fat":"","Saturated Fat":"","Trans Fat":"","Cholesterol":"","Sodium":"","Total Carbohydrates":"","Dietary Fiber":"","Sugars":"","Protein":"","Vitamin A":"","Vitamin C":"","Calcium":"","Iron":"","Packaging":"","Packaging Type":"","Shelf Life":"","Storage Condition":"","Weight Case Net":"","Weight Case Gross":"","Weight Individual Net":"","Weight Individual Gross":"","Weight Individual Drain":""}';

            $this->productDefinitionRepository->updateAttributes($product->id, $attributes);
            Log::info('Added the default 4 Corners attributes to the request');
        }
    }

} 