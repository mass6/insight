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

function jsonToArray($jsonArray)
{
    if(isset($jsonArray))
    {
        $jsonArray = json_decode($jsonArray);

        // final array to be returned
        $attributes = array();

        foreach ($jsonArray as $attribute)
        {
            // if only 1 index, add second blank index
            if ( ! is_object($attribute)  ) {
                $attribute = array($attribute => "");
            }

            foreach($attribute as $key => $val)
            {
                $attributes[] = array($key, $val);
            }

        }
        return json_encode($attributes);
    }
    else
        return false;
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

function formatComment($comment)
{
    return strpos($comment,'||') ? substr($comment,0,strpos($comment,'||')) . '<blockquote>' . substr($comment,strpos($comment,'||') + 2) . '</blockquote>' : $comment;
}