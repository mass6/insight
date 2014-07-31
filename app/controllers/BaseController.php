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
        $company = Session::get('company', '36s');
        $layout = Config::get('view.layout.customer.' . $company, Config::get('view.layout.default', 'layouts.default'));
        return $layout;
    }

}
