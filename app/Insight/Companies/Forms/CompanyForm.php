<?php namespace Insight\Companies\Forms;
use Laracasts\Validation\FormValidator;
use Laracasts\Validation\FormValidationException;
use Log;
/**
 * Insight Client Management Portal:
 * Date: 7/28/14
 * Time: 3:32 PM
 */

class CompanyForm extends FormValidator
{
    protected $rules = [
        'name'                  => 'required|unique:companies',
        'notes'                 => 'max:1000',
        'address1_description'  => 'max:100|required_with:address1_body',
        'address1_body'         => 'max:500',
        'address2_description'  => 'max:100|required_with:address2_body',
        'address2_body'         => 'max:500',
        'address3_description'  => 'max:100|required_with:address3_body',
        'address3_body'         => 'max:500',
        'address4_description'  => 'max:100|required_with:address4_body',
        'address4_body'         => 'max:500'
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
            $formData,
            isset($formData['id']) ?
                $this->ignoreCurrentId($formData['id']) :
                $this->getValidationRules(),
            $this->getValidationMessages()
        );

        if ($this->validation->fails())
        {
            throw new FormValidationException('Validation failed', $this->getValidationErrors());
        }

        return true;
    }

    public function ignoreCurrentId($id)
    {
        $rules = $this->rules;
        $rules['name'] = 'required|unique:companies,name,' . $id;
        return $rules;
    }


} 