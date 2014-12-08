<?php

use Insight\Users\User;

/**
 * Class BaseController
 */
class BaseController extends Controller {

    /**
     * The current user
     * @var
     */
    protected $user;

    protected $company;

    /**
     * Class constructor
     * Sets the current user variable
     */
    public function __construct()
    {
        $this->user = Sentry::getUser();
        $this->company = $this->user->company;

    }

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}

        // variables made available in all views
        View::share([
            'currentUser' => Sentry::getUser(),
            'userCompany' => strtolower(Sentry::getUser()->company->name),
            'layout'      => $this->getLayout(),
            'layoutPath'  => $this->getLayoutPath(),
            'defaultLayout' => 'layouts.' . Config::get('view.layout.default', 'layouts.default')
        ]);
	}

    /**
     * @return string
     */
    protected function getLayout()
    {
        if (Sentry::check()) {
            $company = strtolower(Sentry::getUser()->company->name);

            if ($company !== '36s')
            {
                $layout = Config::get('view.layout.company.' . $company . '.layout', Config::get('view.layout.default'));
                if (! file_exists(__DIR__ . '/../views/layouts/' . $company  . '/' . $layout .'.blade.php')) {
                    $layout = Config::get('view.layout.default', 'layouts.default');
                    return 'layouts.' . $layout;
                }
                return 'layouts.' . $company . '.' . $layout;
            }
            else return 'layouts.' . Config::get('view.layout.default');

        }
        else return 'layouts.' . Config::get('view.layout.default', 'layouts.default');


    }

    /**
     * @return string
     */
    protected function getLayoutPath(){
        if (Sentry::check()) {
            $company = strtolower(Sentry::getUser()->company->name);
            if ($company !== '36s'){
                return Config::get('view.layout.company.' . $company . '.path', 'layouts');
            }
            else return 'layouts';
        }
        else return 'layouts';
    }
}
