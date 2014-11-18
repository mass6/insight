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
     * Company entity that this product is owned by
     *
     * @return mixed
     */
    public function customer()
    {
        return $this->belongsTo('Insight\Companies\Company', 'company_id');
    }

    /**
     * Supplier who is associated with this product
     *
     * @return mixed
     */
    public function supplier()
    {
        return $this->belongsTo('Insight\Companies\Company', 'supplier_id');
    }

    /**
     * User whom product is currently assigned to
     *
     * @return mixed
     */
    public function assignedTo()
    {
        return $this->belongsTo('Insight\Users\User', 'assigned_user_id');
    }

    /**
     * User whom originally created the product
     *
     * @return mixed
     */
    public function createdBy()
    {
        return $this->belongsTo('Insight\Users\User', 'user_id');
    }

    /**
     * Associated images for this product
     *
     * @return mixed
     */
    public function images()
    {
        return $this->morphMany('Insight\ProductDefinitions\ProductImage', 'imageable');
    }

    /**
     * Associated file attachments for this product
     *
     * @return mixed
     */
    public function attachments()
    {
        return $this->morphMany('Insight\ProductDefinitions\ProductAttachment', 'attachable');
    }

    /**
     * Returns the status name associated with the given status ID
     *
     * @return mixed
     */
    public function statusName()
    {
        return $this->belongsTo('Insight\ProductDefinitions\ProductDefinitionStatuses', 'status');
    }

    /**
     * Mutates the database price to standard decimal format when retrieved from DB
     *
     * @return float|string
     */
    public function displayPrice()
    {
        return $this->attributes['price'] ? $this->attributes['price'] / 100 : '';
    }

    /**
     * Mutates the price from web form into integer for persisting to DB
     *
     * @param $price
     */
    public function setPriceAttribute($price)
    {
        if(! empty($price))
           $this->attributes['price'] = $price * 100;
    }

}