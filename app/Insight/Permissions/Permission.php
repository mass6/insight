<?php namespace Insight\Permissions;


class Permission extends \Eloquent {

    protected $fillable = ['name'];

    protected $table = 'permissions';
}