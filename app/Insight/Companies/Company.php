<?php namespace Insight\Companies;

use Laracasts\Commander\Events\EventGenerator;

/**
 * Class Company
 * @package Insight\Companies
 */
class Company extends \Eloquent {

    use EventGenerator;

    /**
     * @var array
     */
    protected $fillable = ['name', 'type', 'notes'];

    /**
     * @var string
     */
    protected $table = 'companies';

    /**
     * @return mixed
     */
    public function users()
    {
        return $this->hasMany('Insight\Users\User');
    }

    /**
     * @return mixed
     */
    public function productDefinitionsOwned()
    {
        return $this->hasMany('Insight\ProductDefinitions\ProductDefinition', 'company_id');
    }

    /**
     * @return mixed
     */
    public function ProductDefinitionsAssigned()
    {
        return $this->hasMany('Insight\ProductDefinitions\ProductDefinition', 'supplier_id');
    }

    /**
     * @return mixed
     */
    public function suppliers()
    {
        return $this->belongsToMany('Insight\Companies\Company', 'customer_supplier', 'customer_id', 'supplier_id');
    }

    /**
     * @return mixed
     */
    public function customers()
    {
        return $this->belongsToMany('Insight\Companies\Company', 'customer_supplier', 'supplier_id', 'customer_id');
    }

    /**
     * @return mixed
     */
    public function attributeSets()
    {
        return $this->hasMany('Insight\ProductDefinitions\AttributeSet');
    }

}