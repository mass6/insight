<?php namespace Admin;

use Insight\Core\CommandBus;
use Illuminate\Support\Facades\Redirect;
use Insight\Settings\SettingRepository;
use Insight\Settings\UpdateSettingsCommand;
use Laracasts\Flash\Flash;
use View, Input;

/**
 * Class SettingsController
 * @package Admin
 */
class SettingsController extends AdminBaseController {

    use CommandBus;

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
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        // fetch an array of name->value pairs, indexed by type
        $settings = $this->setting->getGrouped();

        return View::make('admin.settings.index', compact('settings'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  string $type
	 * @return Response
	 */
	public function update($type)
	{
        $input = Input::all();
        $this->execute(new UpdateSettingsCommand($type, $input));

        Flash::success(ucwords($type) . ' settings were successfully updated.');
        return Redirect::route('admin.settings.index');
	}


}
