<?php namespace Insight\Comments;
/**
 * Created by PhpStorm.
 * User: sam
 * Date: 6/16/14
 * Time: 10:38 AM
 */

class Comment extends \Eloquent

{
    /**
     * Defined attributes that may not be mass-assigned
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Attribute validation rules
     *
     * @var array
     */
    public static $rules = [
        'body'		 	=> 	'required|max:1000',
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'comments';

    /**
     * Polymorphic relation to ItemRequest and Quotation
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function commentable()
    {
        return $this->morphTo();
    }


    public function user()
    {
        return $this->belongsTo('Insight\Users\User');
    }


}