<?php namespace Insight\Settings;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use Insight\Settings\Events\SettingWasUpdated;
use \Log;

/**
 * Insight Client Management Portal:
 * Date: 7/29/14
 * Time: 1:29 AM
 */

class UpdateSettingsCommandHandler implements CommandHandler
{
    use DispatchableTrait;

    /**
     * @var SettingRepository
     */
    protected $setting;

    /**
     * @param SettingRepository $setting
     */
    public function __construct(SettingRepository $setting)
    {
        $this->setting = $setting;
    }

    /**
     * Handle the command
     *
     * @param $command
     * @return mixed
     */
    public function handle($command)
    {
        // fetch all settings with specified type
        $settings = $this->setting->findByType($command->type);

        // loop through settings fields, then each input field
        foreach($settings as $setting)
        {
            // set value to null for any empty checkboxes there were submitted
            $setting['value'] = null;

            // loop through each input field. If field matches setting, set new value
            foreach($command->input as $field => $val){
                if($field === $setting['name']){
                    $setting['value'] = $val;
                    break;
                }
            }

            $setting->save();
        }

    }
}