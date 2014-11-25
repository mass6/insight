<?php namespace Insight\Listeners; 
/**
 * Insight Client Management Portal:
 * Date: 7/26/14
 * Time: 8:11 PM
 */

use Insight\ProductDefinitions\Events\ProductDefinitionWasCreated;
use Insight\ProductDefinitions\Events\ProductDefinitionWasUpdated;
use Insight\ProductDefinitions\Events\ProductDefinitionWasAssigned;
use Insight\ProductDefinitions\Events\ProductDefinitionWasCompleted;
use Log;

class ProductDefinitionHistoryLogger extends EventListener {

    public function whenProductDefinitionWasCreated(ProductDefinitionWasCreated $event)
    {
        $product = $event->productDefinition;
        Log::info('Product Definition Request, ID#' . $product->id
                . '[' . $product->code . ': ' . $product->name . '] '
        . 'was created by ' . $product->createdBy->name() . '.');
    }

    public function whenProductDefinitionWasUpdated(ProductDefinitionWasUpdated $event)
    {
        $product = $event->productDefinition;
        Log::info('Product Definition Request, ID#' . $product->id
            . ' [' . $product->code . ': ' . $product->name . '] '
            . 'was updated by ' . $product->updatedBy->name() . '.');
    }

    public function whenProductDefinitionWasAssigned(ProductDefinitionWasAssigned $event)
    {
        $product = $event->productDefinition;
        Log::info('Product Definition Request, ID#' . $product->id
            . '[' . $product->code . ': ' . $product->name . '] '
            . 'was assigned by ' . $product->assignedBy->name() . ' to ' . $product->assignedTo->name() . '. [' . $product->statusName->name . ']');
    }

    public function whenProductDefinitionWasCompleted(ProductDefinitionWasCompleted $event)
    {
        $product = $event->productDefinition;
        Log::info('Product Definition Request, ID#' . $product->id
            . '[' . $product->code . ': ' . $product->name . '] '
            . 'was completed by ' . $product->updatedBy->name() .'.');
    }
} 