<?php namespace Insight\ProductDefinitions;
/**
 * Created by PhpStorm.
 * User: sam
 * Date: 6/16/14
 * Time: 3:47 PM
 */
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;

/**
 * Class ProductAttachment
 * @package Insight\ProductDefinitions
 */
class ProductAttachment extends \Eloquent implements StaplerableInterface
{
    use EloquentTrait;

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = array()) {
        $this->hasAttachedFile('attachment', [

        ]);

        parent::__construct($attributes);
    }

    /**
     * Defined attributes that may not be mass-assigned
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @return mixed
     */
    public function attachable()
    {
        return $this->morphTo();
    }

}