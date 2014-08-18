<?php

use Illuminate\Console\Command;
use Insight\Portal\Products\UpdateProductsCommandHandler;
use Insight\Portal\Products\UpdateProductsCommand;
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
    }

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
        $localProducts = $this->product->getEmrillProducts()->toArray();
        $portalProducts = $this->portal->getValidationReport('VerifyProducts', 5, 'Emrill', 'array');

        $this->info('Local: ' . count($localProducts) . '  Portal: ' . count($portalProducts));
        $command = new UpdateProductsCommand($localProducts, $portalProducts);
        $handler = new UpdateProductsCommandHandler;
        $results = $handler->handle($command);
        $this->info($results);
	}


}
