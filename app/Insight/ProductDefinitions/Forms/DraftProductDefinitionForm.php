<?php namespace Insight\ProductDefinitions\Forms;
use Laracasts\Validation\FormValidator;
use Laracasts\Validation\FormValidationException;
use Log;
/**
 * Insight Client Management Portal:
 * Date: 11/7/14
 * Time: 1:00 PM
 */

class DraftProductDefinitionForm extends ProductDefinitionFormAbstract
{
    /**
     * @var array
     */
    protected $rules = [
        'company_id' => 'required|integer|exists:companies,id',
        'supplier_id' => 'exists:companies,id',
        'name'  => 'required|max:120',
        'category' => 'max:50',
        'uom' => 'max:25',
        'price' => 'numeric',
        'currency' => 'alpha|size:3',
        'short_description' => 'max:1000',
        'description' => 'max:2000',
        'image1' => 'image|max:1024|mimes:jpg,jpeg,png,gif,bmp,gif',
        'image2' => 'image|max:1024|mimes:jpg,jpeg,png,gif,bmp,gif',
        'image3' => 'image|max:1024|mimes:jpg,jpeg,png,gif,bmp,gif',
        'image4' => 'image|max:1024|mimes:jpg,jpeg,png,gif,bmp,gif',
        'attachment1' => 'max:2048',
        'attachment2' => 'max:2048',
        'attachment3' => 'max:2048',
        'attachment4' => 'max:2048',
        'attachment5' => 'max:2048',
        'remarks' => 'max:1000'
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
//        $formData = $this->addAttributesToFormData($formData);
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

//    /**
//     * @param array $formData
//     * @return array
//     */
//    protected function compileRules(array $formData)
//    {
//        // By default, add Code rule to ensure the code is unique per company
//        $this->rules['code'] = 'required|unique:product_definitions,code,null,company_id,company_id,' . $formData['company_id'];
//
//        // If update to existing request, ignore the unique code rule
//        $rules = isset($formData['id']) && isset($formData['company_id']) ?
//            $this->ignoreCurrentId($formData['id'], $formData['company_id']) :
//            $this->getValidationRules();
//
//        //return $this->addImagesToRules($formData, $rules);
//        return $rules;
//    }
//
//    /**
//     * @param $id
//     * @param $company_id
//     * @return array
//     */
//    protected function ignoreCurrentId($id, $company_id)
//    {
//        $rules = $this->rules;
//        $rules['code'] = 'required|unique:product_definitions,code,' . $id . ',id,company_id,' . $company_id;
//        //$rules['code'] = 'required|unique:product_definitions,code,' . $id . ',company_id,company_id,' . $company_id;
//        //$rules['code'] = 'required|unique:product_definitions,code,null,' . 'company_id,company_id,' . $company_id;
//        return $rules;
//    }


//    /**
//     * If the attributes array is present in the input array, iterate through the input array and add
//     * each index as an individual field to the input array
//     *
//     * @param $formData
//     * @return mixed
//     */
//    protected function addAttributesToFormData($formData)
//    {
//        if(! empty($formData['attributes'])){
//            foreach($formData['attributes'] as $field => $value){
//                $formData[$field] = $value;
//            }
//        }
//        return $formData;
//
//    }
//    /**
//     * If attributes are present in the input array, adds them to the validation rules
//     *
//     * @param $attributes
//     */
//    private function addAttributeRules($attributes)
//    {
//        if (! empty($attributes)){
//            foreach ($attributes as $field => $value) {
//                $this->rules[$field] = 'required|max:200';
//            }
////            Log::info('Rules : ');
////            Log::info($this->rules);
//        }


//    }

//    /**
//     * @param $formData
//     * @param $rules
//     * @return mixed
//     */
//    protected function addImagesToRules($formData, $rules)
//    {
//        if (! is_null($formData['images']))
//        {
//            foreach ($formData['images'] as $image)
//            {
//                if(! is_null($image)) {
//                    $imageName = $image->getClientOriginalName();
//                    $rules[$imageName] = 'image|max:1024|mimes:jpg,jpeg,png,bmp,gif';
//                }
//            }
//        }
//        return $rules;
//    }

//    /**
//     * @param $formData
//     * @return mixed
//     */
//    protected function addImagesToFormData($formData)
//    {
//        if (! is_null($formData['images']))
//        {
//            foreach ($formData['images'] as $image)
//            {
//                if(! is_null($image)) {
//                    $imageName = $image->getClientOriginalName();
//                    $formData[$imageName] = $image;
//                }
//            }
//            unset($formData['images']);
//        }
//        return $formData;
//    }



} 