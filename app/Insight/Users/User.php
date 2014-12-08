<?php namespace Insight\Users;

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Cartalyst\Sentry\Users\Eloquent\User as Sentry;
use Laracasts\Commander\Events\DispatchableTrait;
use Laracasts\Commander\Events\EventGenerator;

/**
 * Class User
 * @package Insight\Users
 */
class User extends Sentry implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait, EventGenerator;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

    /**
     * Array of dates that shall be treated as Carbon objects
     *
     * @var array
     */
    protected $dates = array('last_login');

    /**
     * Concatenates the full name
     *
     * @return string
     */
    public function name()
    {
        return trim($this->first_name . ' ' . $this->last_name);
    }

    /**
     * Gets the user's assigned group names in an indexed array
     *
     * @return array
     */
    public function getAssignedGroups()
    {
        $groups = $this->getGroups();
        $array = [];

        foreach ($groups as $group)
        {
            $array[] = $group->name;
        }
        return $array;

    }

    /**
     * Gets the user's assigned group names in an indexed array
     *
     * @return array
     */
    public function groupNames()
    {
        $groups = [];

        foreach ($this->groups as $group)
        {
            $array[] = $group->name;
        }

        return $groups;
    }

    /**
     * Mutates the last login date to add 'never' in case of null
     * @return string
     */
    public function getLastLoginAttribute()
    {
        $date = $this->attributes['last_login'];
        return ! is_null($date) ? $date  : 'never';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo('Insight\Companies\Company');
    }

    /**
     * Relationship definition to Profile
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne('Insight\Users\Profile');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function notifications()
    {
        return $this->belongsToMany('Insight\Notifications\Notification');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productDefinitionsAssigned()
    {
        return $this->hasMany('Insight\ProductDefinitions\ProductDefinition', 'assigned_user_id');
    }

    public function comments()
    {
        return $this->hasMany('Insight\Comments\Comment');
    }



}
