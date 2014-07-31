<?php

use Insight\Sessions\Forms\SignInForm;

use Cartalyst\Sentry\Facades\Laravel\Sentry;
use Insight\Core\CommandBus;
use Insight\Sessions\LoginUserCommand;

/**
 * Class SessionsController
 */
class SessionsController extends \BaseController {

    use CommandBus;

    /**
     * @var Laracasts\Commander\CommandBus
     */
    private $commandBus;

    /**
     * @var Insight\Sessions\Forms\SignInForm
     */
    private $signInForm;

    /**
     * @param Insight\Sessions\Forms\SignInForm $signInForm
     */
    function __construct(SignInForm $signInForm)
    {
        $this->signInForm = $signInForm;
    }

    /**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('sessions.create');
	}

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        # Response Data Array
        $resp = array();


        // Fields Submitted
        $credentials = array(
            'email'    => Input::get('username'),
            'password' => Input::get('password'),
        );


        // This array of data is returned for demo purpose, see assets/js/neon-forgotpassword.js
        //$resp['submitted_data'] = $_POST;


        // Login success or invalid login data [success|invalid]
        // Your code will decide if username and password are correct
        $login_status = 'invalid';

        try
        {
            $user = $this->execute(
                new LoginUserCommand($credentials)
            );
        }
        catch (Exception $e)
        {
            $message = $e->getMessage();
        }

        if (isset($user)) {
            Session::put([
                'company' => $user->company
            ]);
            $login_status = 'success';
            $resp['login_status'] = $login_status;
            $resp['redirect_url'] = Session::pull('url.intended', '/');
            return Response::json($resp);
        } else {
            // if authentication is fails
            Log::info('no user found');
            $login_status = 'invalid';
            $resp['login_status'] = $login_status;
            $resp['message'] = $message;
            return Response::json( $resp );
        }




        // Login Success URL
//        if($login_status == 'success')
//        {
//            // If you validate the user you may set the user cookies/sessions here
//            #setcookie("logged_in", "user_id");
//            #$_SESSION["logged_user"] = "user_id";
//
//            // Set the redirect url after successful login
//
//        }





//        // fetch the form input
//        $credentials = Input::only('email', 'password');
//        $this->signInForm->validate($credentials);
//
//        try
//        {
//            $user = $this->execute(
//                new LoginUserCommand($credentials)
//            );
//
//            if ($user) {
//                Session::put([
//                    'company' => $user->company
//                ]);
//                Flash::message('Welcome back!');
//                return Redirect::intended('/');
//            }
//        }
//        catch(\Exception $e)
//        {
//            return Redirect::back()->withErrors($e->getMessage());
//        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @internal param int $id
     * @return Response
     */
	public function destroy()
	{
		Sentry::logout();

        Flash::message('You have been logged out.');

        return Redirect::route('login_path');
	}




}
