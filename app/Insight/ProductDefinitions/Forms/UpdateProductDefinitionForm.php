<?php namespace Insight\ProductDefinitions\Forms;
use Laracasts\Validation\FormValidator;
use Laracasts\Validation\FormValidationException;
use Log;
/**
 * Insight Client Management Portal:
 * Date: 11/7/14
 * Time: 1:00 PM
 */

class UpdateProductDefinitionForm extends FormValidator
{
    /**
     * @var array
     */
    protected $rules = [
        'name'  => 'required|max:120',
        'category' => 'required|max:50',
        'uom' => 'required|max:25',
        'price' => 'required|numeric',
        'currency' => 'alpha|size:3',
        'description' => 'required|max:2000',
        'image1' => 'required|image|max:1024|mimes:jpg,jpeg,png,gif,bmp,gif',
        'image2' => 'image|max:1024|mimes:jpg,jpeg,png,gif,bmp,gif',
        'image3' => 'image|max:1024|mimes:jpg,jpeg,png,gif,bmp,gif',
        'image4' => 'image|max:1024|mimes:jpg,jpeg,png,gif,bmp,gif',
        'short_description' => 'required|max:1000',
        'remarks' => 'max:1000',
        'supplier_id' => 'required|exists:companies,id',
        'assigned_user_id' => 'exists:users,id',
        'status' => 'required|integer|min:1|max:7'
    ];



    /**
     * Validate the form data
     *
     * @param array $formData
     * @return mixed
     * @throws FormValidationException
     */
    public function validate(array $formData)
    {
        $formData = $this->addAttributesToFormData($formData);

        $this->validation = $this->validator->make(
            //$this->addImagesToFormData($formData),
            $formData,
            $this->compileRules($formData),
            $this->getValidationMessages()
        );

        if ($this->validation->fails())
        {
            throw new FormValidationException('Validation failed', $this->getValidationErrors());
        }

        //return true;
    }

    /**
     * @param array $formData
     * @return array
     */
    protected function compileRules(array $formData)
    {

        if($formData['existing_images'])
            $this->rules['image1'] = 'image|max:1024|mimes:jpg,jpeg,png,gif,bmp';

        // Ignore the unique code rule for request being updated
        $rules = $this->ignoreCurrentId($formData['id'], $formData['company_id']);

        // Add Code rule to ensure the code is unique per company
        //$rules['code'] = 'required|unique:product_definitions,code,null,company_id,company_id,' . $formData['company_id'];

        //return $this->addImagesToRules($formData, $rules);
        return $rules;
    }

    /**
     * If the attributes array is present in the input array, iterate through the input array and add
     * each index as an individual field to the input array
     *
     * @param $formData
     * @return mixed
     */
    private function addAttributesToFormData($formData)
    {
        if(! empty($formData['attributes'])){
            foreach($formData['attributes'] as $field => $value){
                $formData[$field] = $value;
            }
        }
        return $formData;

    }

    /**
     * @param $id
     * @param $company_id
     * @return array
     */
    public function ignoreCurrentId($id, $company_id)
    {
        $rules = $this->rules;
        $rules['code'] = 'required|unique:product_definitions,code,' . $id . ',id,company_id,' . $company_id;
        //$rules['code'] = 'required|unique:product_definitions,code,' . $id . ',company_id,company_id,' . $company_id;
        //$rules['code'] = 'required|unique:product_definitions,code,null,' . 'company_id,company_id,' . $company_id;
        return $rules;
    }

    /**
     * @param $formData
     * @param $rules
     * @return mixed
     */
    protected function addImagesToRules($formData, $rules)
    {
        if (! is_null($formData['images'][0]))
        {
            foreach ($formData['images'] as $image)
            {
                $imageName = $image->getClientOriginalName();
                $rules[$imageName] = 'image|max:512|mimes:jpg,jpeg,png';
            }
        }
        return $rules;
    }

    /**
     * @param $formData
     * @return mixed
     */
    protected function addImagesToFormData($formData)
    {
        if (! is_null($formData['images'][0]))
        {
            foreach ($formData['images'] as $image)
            {
                $imageName = $image->getClientOriginalName();
                $formData[$imageName] = $image;
            }
            unset($formData['images']);
        }
        return $formData;
    }



} 