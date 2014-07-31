<?php namespace Insight\Users; 
/**
 * Insight Client Management Portal:
 * Date: 7/29/14
 * Time: 4:20 PM
 */
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;

class Profile extends \Eloquent implements StaplerableInterface
{
    use EloquentTrait;

    public function __construct(array $attributes = array()) {
        $this->hasAttachedFile('avatar', [
            'styles' => [
                'medium' => '300x300',
                'thumb' => '100x100'
            ]
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
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'profiles';

    /**
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo('Insight\Users\User');
    }
}