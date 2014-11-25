<?php namespace Insight\Libraries; 
/**
 * Insight Client Management Portal:
 * Date: 11/25/14
 * Time: 12:20 AM
 */

class Settings 
{
    private $settings;

    public function __construct($settings)
    {
        $this->settings = object_to_array(json_decode($settings));

        if(!empty($settings))
        {
            foreach($this->settings as $key => $value)
                $this->{$key} = $value;
        }
    }

    public function all()
    {
        return $this->settings;
    }

    public function __get($key)
    {
        $key = str_replace('get','',$key);
        if(isset($this->settings[$key]))
        {
            return $this->settings[$key];
        }
        return null;
    }
} 