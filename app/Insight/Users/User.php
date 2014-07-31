<?php namespace Insight\Users;

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Cartalyst\Sentry\Users\Eloquent\User as Sentry;
use Laracasts\Commander\Events\DispatchableTrait;
use Laracasts\Commander\Events\EventGenerator;
use Log;

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
        return $this->first_name . ' ' . $this->last_name;
    }


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

    public function groupNames()
    {
        $groups = [];

        foreach ($this->groups as $group)
        {
            $array[] = $group->name;
        }

        return $groups;
    }

    public function getLastLoginAttribute()
    {
        $date = $this->attributes['last_login'];
        return ! is_null($date) ? $date  : 'never';
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




}
