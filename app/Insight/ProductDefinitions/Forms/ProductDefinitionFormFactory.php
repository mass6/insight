<?php namespace Insight\ProductDefinitions\Forms;
use Insight\Companies\Company;
use Insight\Users\User;

/**
 * Insight Client Management Portal:
 * Date: 12/3/14
 * Time: 10:42 AM
 */

class ProductDefinitionFormFactory 
{

    /**
     * @var NewProductDefinitionForm
     */
    private $newProductDefinitionForm;
    /**
     * @var DraftProductDefinitionForm
     */
    private $draftProductDefinitionForm;
    /**
     * @var UpdateProductDefinitionForm
     */
    private $updateProductDefinitionForm;
    /**
     * @var UpdateLimitedProductDefinitionForm
     */
    private $updateLimitedProductDefinitionForm;
    /**
     * @var ProductDefinitionForm
     */
    private $productDefinitionForm;

    /**
     * @param DraftProductDefinitionForm $draftProductDefinitionForm
     * @param ProductDefinitionForm $productDefinitionForm
     * @param NewProductDefinitionForm $newProductDefinitionForm
     * @param UpdateProductDefinitionForm $updateProductDefinitionForm
     * @param UpdateLimitedProductDefinitionForm $updateLimitedProductDefinitionForm
     */
    public function __construct(
        DraftProductDefinitionForm $draftProductDefinitionForm,
        ProductDefinitionForm $productDefinitionForm,
        NewProductDefinitionForm $newProductDefinitionForm,
        UpdateProductDefinitionForm $updateProductDefinitionForm,
        UpdateLimitedProductDefinitionForm $updateLimitedProductDefinitionForm
    )
    {
        $this->newProductDefinitionForm = $newProductDefinitionForm;
        $this->draftProductDefinitionForm = $draftProductDefinitionForm;
        $this->updateProductDefinitionForm = $updateProductDefinitionForm;
        $this->updateLimitedProductDefinitionForm = $updateLimitedProductDefinitionForm;
        $this->productDefinitionForm = $productDefinitionForm;
    }

    public function make($action, User $user, Company $company)
    {
        switch ($action){
            case "save":
            case "assign-to-customer":
            case "assign-to-supplier":
                return $this->draftProductDefinitionForm;
            case "update":
            case "submit":
            case "process":
            case "complete":
                if ($customForm = $company->settings()->getCustomValidationForm)
                {
                    $decorator = new FourCValidationFormDecorator($this->productDefinitionForm);
                    return $decorator->decorate();
                }
                return  $this->productDefinitionForm;
        }

    }
} 