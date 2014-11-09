<?php

class BaseController extends Controller {

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

        View::share([
            'currentUser' => Sentry::getUser(),
            'layout'      => $this->getLayout(),
            'layoutPath'  => $this->getLayoutPath(),
            'defaultLayout' => 'layouts.' . Config::get('view.layout.default', 'layouts.default')
        ]);
	}

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
