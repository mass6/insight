<?php namespace Admin;

use Config;

class AdminBaseController extends \BaseController {

    public function getLayout()
    {
        $layout = Config::get('view.layout.admin', 'layouts.default');
        return $layout;
    }


}
