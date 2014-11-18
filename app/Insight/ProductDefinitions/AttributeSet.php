<?php namespace Insight\ProductDefinitions;

/**
 * Class Company
 * @package Insight\ProductDefinitions
 */
use Laracasts\Commander\Events\EventGenerator;

/**
 * Class ProductDefinition
 * @package Insight\ProductDefinitions
 */
class AttributeSet extends \Eloquent {

    use EventGenerator;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'company_id'
    ];

    /**
     * @var string
     */
    protected $table = 'attribute_sets';


    /**
     * Has to one or many attributes
     *
     * @return mixed
     */
    public function attributes()
    {
        return $this->belongsToMany('Insight\ProductDefinitions\Attribute');
    }

    public function company()
    {
        return $this->belongsTo('Insight\Companies\Company');
    }





}