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
class Attribute extends \Eloquent {

    use EventGenerator;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'type'
    ];

    /**
     * @var string
     */
    protected $table = 'attributes';


    /**
     * Belongs to one or many Attribute Sets
     *
     * @return mixed
     */
    public function attributeSets()
    {
        return $this->belongsToMany('Insight\ProductDefinitions\AttributeSet');
    }





}