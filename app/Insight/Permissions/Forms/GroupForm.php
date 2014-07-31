<?php namespace Insight\Permissions\Forms;
use Laracasts\Validation\FormValidator;
use Laracasts\Validation\FormValidationException;
/**
 * Insight Client Management Portal:
 * Date: 7/28/14
 * Time: 3:32 PM
 */

class GroupForm extends FormValidator
{
    protected $rules = [
        'name'  => 'required|unique:groups',
        'permissions' => 'array'
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
        $rules['name'] = 'required|unique:groups,name,' . $id;
        return $rules;
    }


} 