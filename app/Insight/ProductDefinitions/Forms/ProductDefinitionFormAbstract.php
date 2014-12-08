<?php namespace Insight\ProductDefinitions\Forms;
use Laracasts\Validation\FormValidator;
use Laracasts\Validation\FormValidationException;
use Log;
/**
 * Insight Client Management Portal:
 * Date: 11/7/14
 * Time: 1:00 PM
 */

abstract class ProductDefinitionFormAbstract extends FormValidator {

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
        if(isset($formData['attributes_required']))
            $this->addAttributeRules($formData['attributes']);

        // if existing images exist, change the rules to ignore the any required images.
        $this->ignoreRequiredImageRules($formData);

        // if existing attachments exist, change the rules to ignore the any required attachments.
        $this->ignoreRequiredAttachmentRules($formData);

        // By default, add Code rule to ensure the code is unique per company
        $this->rules['code'] = 'required|unique:product_definitions,code,null,company_id,company_id,' . $formData['company_id'];

        // If update to existing request, ignore the unique code rule
        $rules = isset($formData['id']) && isset($formData['company_id']) ?
            $this->ignoreCurrentId($formData['id'], $formData['company_id']) :
            $this->getValidationRules();

        //return $this->addImagesToRules($formData, $rules);
        //dd($rules);
        return $rules;
    }

    /**
     * @param $id
     * @param $company_id
     * @return array
     */
    protected function ignoreCurrentId($id, $company_id)
    {
        $rules = $this->rules;
        $rules['code'] = 'required|unique:product_definitions,code,' . $id . ',id,company_id,' . $company_id;
        //$rules['code'] = 'required|unique:product_definitions,code,' . $id . ',company_id,company_id,' . $company_id;
        //$rules['code'] = 'required|unique:product_definitions,code,null,' . 'company_id,company_id,' . $company_id;
        return $rules;
    }

    /**
     * If existing images are present, change the form rule to not require the image in the form data
     * @param $formData
     */
    protected function ignoreRequiredImageRules($formData)
    {
        for ($image = 1; $image <= 4; $image++ )
        {
            if (isset($formData['existingImage' . $image]))
                $this->rules['image' . $image] = 'image|max:1024|mimes:jpg,jpeg,png,gif,bmp,gif';

        }
    }

    /**
     * If existing images are present, change the form rule to not require the image in the form data
     * @param $formData
     */
    protected function ignoreRequiredAttachmentRules($formData)
    {
        for ($attachment = 1; $attachment <= 5; $attachment++ )
        {
            if (isset($formData['existingAttachment' . $attachment]))
                $this->rules['attachment' . $attachment] = 'max:2048';

        }
    }

    /**
     * If the attributes array is present in the input array, iterate through the input array and add
     * each index as an individual field to the input array
     *
     * @param $formData
     * @return mixed
     */
    protected function addAttributesToFormData($formData)
    {
        if(! empty($formData['attributes'])){
            foreach($formData['attributes'] as $field => $value){
                $formData[$field] = $value;
            }
        }
        return $formData;

    }

    /**
     * Adds attributes to the validation rules
     *
     * @param $attributes
     */
    protected function addAttributeRules($attributes)
    {
        if (! empty($attributes)){
            foreach ($attributes as $field => $value) {
                $this->rules[$field] = 'required|max:200';
            }
//            Log::info('Rules : ');
//            Log::info($this->rules);
        }
    }

    /**
     * @param $formData
     * @return mixed
     */
    protected function addImagesToFormData($formData)
    {
        if (! is_null($formData['images']))
        {
            foreach ($formData['images'] as $image)
            {
                if(! is_null($image)) {
                    $imageName = $image->getClientOriginalName();
                    $formData[$imageName] = $image;
                }
            }
            unset($formData['images']);
        }
        return $formData;
    }

    /**
     * @param $formData
     * @param $rules
     * @return mixed
     */
    protected function addImagesToRules($formData, $rules)
    {
        if (! is_null($formData['images']))
        {
            foreach ($formData['images'] as $image)
            {
                if(! is_null($image)) {
                    $imageName = $image->getClientOriginalName();
                    $rules[$imageName] = 'image|max:1024|mimes:jpg,jpeg,png,bmp,gif';
                }
            }
        }
        return $rules;
    }

    public function setMessage($rule, $message)
    {
        $this->messages[$rule] = $message;
    }

    protected $messages = [
        'image1.required' => 'You must include the main product photo.',
    ];



} 