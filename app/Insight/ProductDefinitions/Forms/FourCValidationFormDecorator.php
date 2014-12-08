<?php namespace Insight\ProductDefinitions\Forms;
use Insight\ProductDefinitions\ProductDefinition;
use Laracasts\Validation\FormValidator;

/**
 * Insight Client Management Portal:
 * Date: 12/6/14
 * Time: 10:04 PM
 */

class FourCValidationFormDecorator 
{
    /**
     * @var ProductDefinitionForm
     */
    private $productDefinitionForm;

    public function __construct(ProductDefinitionForm $productDefinitionForm)
    {
        $this->productDefinitionForm = $productDefinitionForm;
    }

    public function decorate()
    {
        $this->setRules();
        $this->setMessages();

        return $this->productDefinitionForm;
    }

    private function setRules()
    {
        $this->productDefinitionForm->rules['image2'] = 'required|image|max:1024|mimes:jpg,jpeg,png,gif,bmp,gif';
        $this->productDefinitionForm->rules['image3'] = 'required|image|max:1024|mimes:jpg,jpeg,png,gif,bmp,gif';
        $this->productDefinitionForm->rules['attachment1'] = 'required|max:2048';
        $this->productDefinitionForm->rules['attribute-value-brand'] = 'required';
        $this->productDefinitionForm->rules['attribute-value-hscode'] = 'required';
        $this->productDefinitionForm->rules['attribute-value-barcodenumbercase'] = 'required';
        $this->productDefinitionForm->rules['attribute-value-countryofmanufacture'] = 'required';
        $this->productDefinitionForm->rules['attribute-value-leadtime'] = 'required';
        $this->productDefinitionForm->rules['attribute-value-barcodenumberindividual'] = 'required';
        $this->productDefinitionForm->rules['attribute-value-ingredients'] = 'required';
        $this->productDefinitionForm->rules['attribute-value-energykcal'] = 'required';
        $this->productDefinitionForm->rules['attribute-value-energykj'] = 'required';
        $this->productDefinitionForm->rules['attribute-value-fat'] = 'required';
        $this->productDefinitionForm->rules['attribute-value-saturates'] = 'required';
        $this->productDefinitionForm->rules['attribute-value-carbohydrates'] = 'required';
        $this->productDefinitionForm->rules['attribute-value-sugars'] = 'required';
        $this->productDefinitionForm->rules['attribute-value-protein'] = 'required';
        $this->productDefinitionForm->rules['attribute-value-salt'] = 'required';
        $this->productDefinitionForm->rules['attribute-value-packaging'] = 'required';
        $this->productDefinitionForm->rules['attribute-value-packingtype'] = 'required';
        $this->productDefinitionForm->rules['attribute-value-shelflife'] = 'required';
        $this->productDefinitionForm->rules['attribute-value-storagecondition'] = 'required';
        $this->productDefinitionForm->rules['attribute-value-caselength'] = 'required';
        $this->productDefinitionForm->rules['attribute-value-casewidth'] = 'required';
        $this->productDefinitionForm->rules['attribute-value-casedepth'] = 'required';
        $this->productDefinitionForm->rules['attribute-value-casesperpallet'] = 'required';
        $this->productDefinitionForm->rules['attribute-value-casesperpalletrow'] = 'required';
        $this->productDefinitionForm->rules['attribute-value-casespercontainer'] = 'required';
        $this->productDefinitionForm->rules['attribute-value-weightcasenet'] = 'required';
        $this->productDefinitionForm->rules['attribute-value-weightcasegross'] = 'required';
        $this->productDefinitionForm->rules['attribute-value-weightindividualnet'] = 'required';
        $this->productDefinitionForm->rules['attribute-value-weightindividualgross'] = 'required';
    }

    private function setMessages()
    {
        $this->productDefinitionForm->setMessage('image1.required', 'The main product photo is required.');
        $this->productDefinitionForm->setMessage('image2.required', 'A product back photo is required.');
        $this->productDefinitionForm->setMessage('image3.required', 'The outer case label photo is required.');
        $this->productDefinitionForm->setMessage('attachment1.required', 'The product specification sheet is required.');
        $this->productDefinitionForm->setMessage('attribute-value-brand.required', 'The brand is required.');
        $this->productDefinitionForm->setMessage('attribute-value-hscode.required', 'The HS Code is required.');
        $this->productDefinitionForm->setMessage('attribute-value-barcodenumbercase.required', 'The barcode number (case) is required.');
        $this->productDefinitionForm->setMessage('attribute-value-barcodenumberindividual.required', 'The barcode number (individual) is required.');
        $this->productDefinitionForm->setMessage('attribute-value-countryofmanufacture.required', 'The country of manufacture is required.');
        $this->productDefinitionForm->setMessage('attribute-value-leadtime.required', 'The lead time is required.');
        $this->productDefinitionForm->setMessage('attribute-value-ingredients.required', 'The ingredients are required.');
        $this->productDefinitionForm->setMessage('attribute-value-energykcal.required', 'The Energy (kcal) is required.');
        $this->productDefinitionForm->setMessage('attribute-value-energykj.required', 'The Energy (kJ) is required.');
        $this->productDefinitionForm->setMessage('attribute-value-fat.required', 'The Fat is required.');
        $this->productDefinitionForm->setMessage('attribute-value-saturates.required', 'The Saturates is required.');
        $this->productDefinitionForm->setMessage('attribute-value-carbohydrates.required', 'The Carbohydrates is required.');
        $this->productDefinitionForm->setMessage('attribute-value-sugars.required', 'The Sugars is required.');
        $this->productDefinitionForm->setMessage('attribute-value-protein.required', 'The Protein is required.');
        $this->productDefinitionForm->setMessage('attribute-value-salt.required', 'The Salt is required.');
        $this->productDefinitionForm->setMessage('attribute-value-vitamina.required', 'The Vitamin A is required.');
        $this->productDefinitionForm->setMessage('attribute-value-vitaminc.required', 'The Vitamin C is required.');
        $this->productDefinitionForm->setMessage('attribute-value-vitaminc.required', 'The Vitamin C is required.');
        $this->productDefinitionForm->setMessage('attribute-value-calcium.required', 'The calcium is required.');
        $this->productDefinitionForm->setMessage('attribute-value-iron.required', 'The iron is required.');
        $this->productDefinitionForm->setMessage('attribute-value-packingtype.required', 'The packing type is required.');
        $this->productDefinitionForm->setMessage('attribute-value-shelflife.required', 'The shelf life is required.');
        $this->productDefinitionForm->setMessage('attribute-value-storagecondition.required', 'The storage condition is required.');
        $this->productDefinitionForm->setMessage('attribute-value-caselength.required', 'The case length is required.');
        $this->productDefinitionForm->setMessage('attribute-value-casewidth.required', 'The case width is required.');
        $this->productDefinitionForm->setMessage('attribute-value-casedepth.required', 'The case depth is required.');
        $this->productDefinitionForm->setMessage('attribute-value-casesperpallet.required', 'The cases per pallet is required.');
        $this->productDefinitionForm->setMessage('attribute-value-casesperpalletrow.required', 'The cases per pallet row is required.');
        $this->productDefinitionForm->setMessage('attribute-value-casespercontainer.required', 'The cases per container is required.');
        $this->productDefinitionForm->setMessage('attribute-value-weightcasenet.required', 'The weight case (net) is required.');
        $this->productDefinitionForm->setMessage('attribute-value-weightcasegross.required', 'The weight case (gross) is required.');
        $this->productDefinitionForm->setMessage('attribute-value-weightindividualnet.required', 'The weight individual (net) is required.');
        $this->productDefinitionForm->setMessage('attribute-value-weightindividualgross.required', 'The weight individual (gross) is required.');
    }
} 