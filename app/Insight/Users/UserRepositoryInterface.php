<?php namespace Insight\Users;
/**
 * Created by:
 * User: sam
 * Date: 7/27/14
 * Time: 2:02 PM
 */


interface UserRepositoryInterface
{
    public function getAll();

    public function find($id);

}
