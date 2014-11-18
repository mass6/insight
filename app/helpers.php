<?php
/**
 * Created by:
 * User: sam
 * Date: 7/27/14
 * Time: 11:06 AM
 */

function getLayout()
{
    $company = Session::get('company', '36s');
    $layout = 'layouts.' . Config::get('view.layout.customer.' . $company, Config::get('view.layout.default', 'layouts.default'));
    return $layout;
}

/**
 * @param $link
 * @param int $seg
 * @param bool $parent
 * @return string
 */
function isActive($link, $seg = 1, $parent = false)
{
    $class = '';
    $segment = Request::segment($seg);
    if ($segment == $link){
        if ($parent == true){
            return 'opened active';
        }
        else return 'active';
    }
    return '';
}

/**
 * Converts and object to an array
 *
 * @param $data
 * @return array
 */
function object_to_array($data)
{
    if(is_array($data) || is_object($data))
    {
        $result = array();

        foreach($data as $key => $value) {
            $result[$key] = object_to_array($value);
        }

        return $result;
    }

    return $data;
}

/**
 * Converts a price to integer for persisting to db
 *
 * @param $price
 * @return mixed
 */
function priceToInteger($price)
{
    return $price * 100;
}