<?php

use Illuminate\Console\Command;
use Insight\Portal\Products\UpdateProductsCommandHandler;
use Insight\Portal\Products\UpdateProductsCommand;
use Illuminate\Support\Facades\Config;
use \Log;
class VerifyProductsCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'insight:verify-products';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Verifies that local product data matches latest product data from portal.';

    /**
     * @var array
     */
    protected $customers;

    private $portal;
    /**
     * @var Insight\Portal\Contracts\Contract
     */
    private $product;

    /**
     * @param \Insight\Portal\Repositories\Portal $portal
     * @param \Insight\Portal\Products\ProductRepository $product
     */
    public function __construct(Insight\Portal\Repositories\Portal $portal, Insight\Portal\Products\ProductRepository $product)
    {
        parent::__construct();
        $this->portal = $portal;
        $this->product = $product;
        $this->customers = Config::get('insight.customers');
    }

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
        foreach($this->customers as $customer)
        {
            $localProducts = $this->product->getCustomerProducts($customer)->toArray();
            $portalProducts = $this->portal->getValidationReport('VerifyProducts', $customer['store'], $customer['name'], 'array');

            $this->info("Products for {$customer['name']} \r\n" . 'Local: ' . count($localProducts) . '  Portal: ' . count($portalProducts));
            $command = new UpdateProductsCommand($localProducts, $portalProducts, $customer);
            $handler = new UpdateProductsCommandHandler;
            $results = $handler->handle($command);
            $this->info($results);
        }

	}


}
