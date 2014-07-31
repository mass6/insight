<?php namespace Insight\Permissions;

use Cartalyst\Sentry\Groups\Eloquent\Group as SentryGroup;
use Laracasts\Commander\Events\EventGenerator;

class Group extends SentryGroup {

    use EventGenerator;

    protected $fillable = ['name', 'permissions'];

    protected $table = 'groups';

    /**
     * Serializes the permissions string
     *
     * @return string
     */
    public function serialedPermissions()
    {
        $string = '';

        foreach ($this->permissions as $key => $val)
        {
            $string .= "{$key} \r\n";
        }
        return $string;
    }

    public function getAssignedPermissions()
    {
        $array = [];

        foreach ($this->getAttribute('permissions') as $key => $val)
        {
            $array[] = $key;
        }
        return $array;

    }
}