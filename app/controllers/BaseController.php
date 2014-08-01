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
            'defaultLayout' => Config::get('view.layout.default', 'layouts.default')
        ]);
	}

    public function getLayout()
    {
        if (Sentry::check()) {
            $company = Sentry::getUser()->company;
            $layout = Config::get('view.layout.customer.' . $company, Config::get('view.layout.default', 'layouts.default'));

            if (! file_exists(__DIR__ . '/../app/views/layouts/' . $layout . '.blade.php')) {
                $layout = Config::get('view.layout.default', 'layouts.default');
            }
            return $layout;
        } else {
            return Config::get('view.layout.default', 'layouts.default');
        }
    }

}
