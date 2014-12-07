<?php namespace Insight\ProductDefinitions\Forms;
use Laracasts\Validation\FormValidator;
use Laracasts\Validation\FormValidationException;
use Log;
/**
 * Insight Client Management Portal:
 * Date: 11/7/14
 * Time: 1:00 PM
 */

class ProductDefinitionForm extends ProductDefinitionFormAbstract
{
    /**
     * @var array
     */
    public $rules = [
        'company_id' => 'required|integer|exists:companies,id',
        'supplier_id' => 'required|exists:companies,id',
        'name'  => 'required|max:120',
        'category' => 'required|max:50',
        'uom' => 'required|max:25',
        'price' => 'required|numeric',
        'currency' => 'alpha|size:3',
        'short_description' => 'required|max:1000',
        'description' => 'required|max:2000',
        'image1' => 'required|image|max:1024|mimes:jpg,jpeg,png,gif,bmp,gif',
        'image2' => 'image|max:1024|mimes:jpg,jpeg,png,gif,bmp,gif',
        'image3' => 'image|max:1024|mimes:jpg,jpeg,png,gif,bmp,gif',
        'image4' => 'image|max:1024|mimes:jpg,jpeg,png,gif,bmp,gif',
        'attachment1' => 'max:2048',
        'attachment2' => 'max:2048',
        'attachment3' => 'max:2048',
        'attachment4' => 'max:2048',
        'attachment5' => 'max:2048',
        'remarks' => 'max:1000',
    ];



//    /**
//     * Validate the form data
//     *
//     * @param array $formData
//     * @return mixed
//     * @throws FormValidationException
//     */
//    public function validate(array $formData)
//    {
//
//        $formData = $this->addAttributesToFormData($formData);
//
//        $this->validation = $this->validator->make(
//            //$this->addImagesToFormData($formData),
//            $formData,
//            $this->compileRules($formData),
//            $this->getValidationMessages()
//        );
//
//        if ($this->validation->fails())
//        {
//            throw new FormValidationException('Validation failed', $this->getValidationErrors());
//        }
//
//        //return true;
//    }

    /**
     * @param array $formData
     * @return array
     */
//    protected function compileRules(array $formData)
//    {
//        if (isset($formData['attributes_required']))
//            $this->addAttributeRules($formData['attributes']);
//
//        if (isset($formData['existingImage1']))
//            $this->rules['image1'] = 'image|max:1024|mimes:jpg,jpeg,png,gif,bmp,gif';
//
//        // Add Code rule to ensure the code is unique per company
//        //$rules['code'] = 'required|unique:product_definitions,code,null,company_id,company_id,' . $formData['company_id'];
//        $this->rules['code'] = 'required|unique:product_definitions,code,null,company_id,company_id,' . $formData['company_id'];
//
//
//        // collect and return all rules
//        $rules = $this->getValidationRules();
//
//
//        //return $this->addImagesToRules($formData, $rules);
//        return $rules;
//
//    }
//
//    /**
//     * @param $id
//     * @return array
//     */
//    public function ignoreCurrentId($id)
//    {
//        $rules = $this->rules;
//        $rules['code'] = 'required|unique:product_definitions,code,' . $id;
//        return $rules;
//    }



} 