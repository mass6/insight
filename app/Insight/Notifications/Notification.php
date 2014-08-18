<?php namespace Insight\Notifications; 
/**
 * Insight Client Management Portal:
 * Date: 8/18/14
 * Time: 8:59 AM
 */

class Notification extends \Eloquent
{
    protected $guarded = ['id'];

    protected $table = 'notifications';

    public function users()
    {
        return $this->belongsToMany('Insight\Users\User');
    }
} 