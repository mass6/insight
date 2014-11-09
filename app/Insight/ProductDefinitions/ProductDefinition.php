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
class ProductDefinition extends \Eloquent {

    use EventGenerator;

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'company_id',
        'code',
        'name',
        'category',
        'uom',
        'price',
        'currency',
        'description',
        'attributes',
        'remarks',
        'supplier_id',
        'assigned_user_id',
        'status',
    ];

    /**
     * @var string
     */
    protected $table = 'product_definitions';

    /**
     * @return mixed
     */
    public function customer()
    {
        return $this->belongsTo('Insight\Companies\Company', 'company_id');
    }

    /**
     * @return mixed
     */
    public function supplier()
    {
        return $this->belongsTo('Insight\Companies\Company', 'supplier_id');
    }

    /**
     * @return mixed
     */
    public function assignedTo()
    {
        return $this->belongsTo('Insight\Users\User', 'assigned_user_id');
    }

    /**
     * @return mixed
     */
    public function images()
    {
        return $this->morphMany('Insight\ProductDefinitions\ProductImage', 'imageable');
    }

    /**
     * @return mixed
     */
    public function attachments()
    {
        return $this->morphMany('Insight\ProductDefinitions\ProductAttachment', 'attachable');
    }

    public function statusName()
    {
        return $this->belongsTo('Insight\ProductDefinitions\ProductDefinitionStatuses', 'status');
    }

    public function displayPrice()
    {
        return $this->attributes['price'] ? $this->attributes['price'] / 100 : '';
    }

    public function setPriceAttribute($price)
    {
        if(! empty($price))
           $this->attributes['price'] = $price * 100;
    }

}