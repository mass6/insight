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
    Log::info($layout);
    return $layout;
}

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