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
        'category' => 'max:50',
        'uom' => 'max:25',
        'price' => 'numeric',
        'currency' => 'alpha|size:3',
        'description' => 'max:2000',
        'short_description' => 'max:1000',
        'remarks' => 'max:1000',
        'supplier_id' => 'exists:companies,id',
        'assigned_user_id' => 'exists:users,id',
        'status' => 'integer|min:1|max:7',
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

        $this->validation = $this->validator->make(
            $this->addImagesToFormData($formData),
            $this->compileRules($formData),
            $this->getValidationMessages()
        );

        if ($this->validation->fails())
        {
            Log::info('validation failed');
            Log::info($this->getValidationErrors());
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
        $rules = isset($formData['id']) ?
            $this->ignoreCurrentId($formData['id'], $formData['company_id']) :
            $this->getValidationRules();

        // Add Code rule to ensure the code is unique per company
        //$rules['code'] = 'required|unique:product_definitions,code,null,company_id,company_id,' . $formData['company_id'];

        return $this->addImagesToRules($formData, $rules);

    }

    /**
     * @param $id
     * @param $company_id
     * @return array
     */
    public function ignoreCurrentId($id, $company_id)
    {
        $rules = $this->rules;
        $rules['code'] = 'required|unique:product_definitions,code,' . $id;
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