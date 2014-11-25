<?php namespace Insight\ProductDefinitions;

/**
 * Class Company
 * @package Insight\ProductDefinitions
 */
use Laracasts\Commander\Events\EventGenerator;
use Insight\Users\User;
use Insight\Settings\Setting;

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
        'short_description',
        'attributes',
        'remarks',
        'supplier_id',
        'updated_by_id',
        'assigned_user_id',
        'assigned_by_id',
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
     * User whom product was last assigned by
     *
     * @return mixed
     */
    public function assignedBy()
    {
        return $this->belongsTo('Insight\Users\User', 'assigned_by_id');
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
     * Last user to update the product
     *
     * @return mixed
     */
    public function updatedBy()
    {
        return $this->belongsTo('Insight\Users\User', 'updated_by_id');
    }

    public function cataloguer()
    {
        return User::find(Setting::where('name', 'primary-cataloguer')->pluck('value'));
    }

    public function processer()
    {
        return User::find(Setting::where('name', 'primary-provisioner')->pluck('value'));
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
    public function getPriceAttribute()
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

    /**
     * Relation definition to Comment
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function comments()
    {
        return $this->morphMany('Insight\Comments\Comment', 'commentable')->orderBy('id', 'DESC');
    }

}