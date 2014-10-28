<?php namespace Insight\Settings;
/**
 * Insight Client Management Portal:
 * Date: 7/28/14
 * Time: 3:32 PM
 */

/**
 * Class SettingRepository
 * @package Insight\Settings
 */
class SettingRepository
{
    /**
     * @return mixed
     */
    public function getAll()
    {
        return Setting::all();
    }

    /**
     * @param $type
     * @return mixed
     */
    public function findByType($type)
    {
        return Setting::where('type', $type)->get();
    }

    /**
     * @return mixed
     */
    public function getTypes()
    {
        // returns a distinct column list of setting types
        return Setting::distinct()->lists('type');
    }

    /**
     *
     *
     * @return array
     */
    public function getGrouped()
    {
        $types = $this->getTypes();
        $settings = [];

        // build the array of name/value settings
        foreach($types as $type)
        {
            $typeSettings = $this->findByType($type);
            foreach($typeSettings as $index => $value){
                $settings[$type][$value['name']] = $value['value'];
            }
        }
        return $settings;
    }


} 