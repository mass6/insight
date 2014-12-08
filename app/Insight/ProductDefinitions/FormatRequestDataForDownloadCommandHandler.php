<?php namespace Insight\ProductDefinitions;
use Insight\Portal\Products\Product;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use Insight\ProductDefinitions\ProductDefinitionRepository;
/**
 * Insight Client Management Portal:
 * Date: 11/30/14
 * Time: 11:48 AM
 */

class FormatRequestDataForDownloadCommandHandler implements CommandHandler
{
    use DispatchableTrait;

    /**
     * @var ProductDefinitionRepository
     */
    private $productDefinitionRepository;

    public function __construct(ProductDefinitionRepository $productDefinitionRepository)
    {
        $this->productDefinitionRepository = $productDefinitionRepository;
    }

    public function handle($command)
    {
        switch ($command->filter){
            case "all":
                $products =  $this->productDefinitionRepository->getAllByCustomer($customerId =2);
                break;
            case "completed":
                $products =  $this->productDefinitionRepository->getCompletedByCustomer($customerId = 2);
                break;
            default:
                return false;

        }

        //dd(json_decode($products[0]->attributes));

        $header = [
            'Customer',
            'Code',
            'Name',
            'Supplier',
            'Category',
            'UOM',
            'Price',
            'Brand',
            'HS Code',
            'Barcode',
            'Country of Manufacture',
            'Lead Time(days)',
            'Ingredients',
            'Calories(g)',
            'Calories from Fat(g)',
            'Total Fat(g)',
            'Saturated Fat(g)',
            'Trans Fat(g)',
            'Cholesterol(g)',
            'Sodium(g)',
            'Total Carbohydrates(g)',
            'Dietary Fiber(g)',
            'Sugars(g)',
            'Protein(g)',
            'Vitamin A(%)',
            'Vitamin C(%)',
            'Calcium(%)',
            'Iron(%)',
            'Packaging',
            'Packaging Type',
            'Shelf Life(months)',
            'Storage Condition',
            'Weight Case: Net(kg)',
            'Weight Case: Gross(kg)',
            'Weight Individual: Net(kg)',
            'Weight Individual: Gross(kg)',
            'Weight Individual: Drain(kg)',
            'Short Description',
            'Full Description'
        ];

        $data[] = $header;

        foreach ($products as $product)
        {
           $attributes = json_decode($product->attributes);
           $data[] = [
               $product->customer->name,
               $product->code,
               $product->name,
               $product->supplier ? $product->supplier->name : '',
               $product->category,
               $product->uom,
               $product->price,
               $attributes->{'Brand'},
               $attributes->{'HS Code'},
               $attributes->{'Barcode Number'},
               $attributes->{'Country of Manufacture'},
               $attributes->{'Lead Time'},
               $attributes->{'Ingredients'},
               $attributes->{'Calories'},
               $attributes->{'Calories From Fat'},
               $attributes->{'Total Fat'},
               $attributes->{'Saturated Fat'},
               $attributes->{'Trans Fat'},
               $attributes->{'Cholesterol'},
               $attributes->{'Sodium'},
               $attributes->{'Total Carbohydrates'},
               $attributes->{'Dietary Fiber'},
               $attributes->{'Sugars'},
               $attributes->{'Protein'},
               $attributes->{'Vitamin A'},
               $attributes->{'Vitamin C'},
               $attributes->{'Calcium'},
               $attributes->{'Iron'},
               $attributes->{'Packaging'},
               $attributes->{'Packaging Type'},
               $attributes->{'Shelf Life'},
               $attributes->{'Storage Condition'},
               $attributes->{'Weight Case Net'},
               $attributes->{'Weight Case Gross'},
               $attributes->{'Weight Individual Net'},
               $attributes->{'Weight Individual Gross'},
               $attributes->{'Weight Individual Drain'},
               $product->short_description,
               $product->description

           ];
        }
        return $data;

    }

} 