<?php

use Insight\Core\CommandBus;
use Insight\Sessions\Forms\UpdatePasswordForm;
use Insight\Users\UserRepository;
use Cartalyst\Sentry\Facades\Laravel\Sentry;

class PasswordsController extends \BaseController {

    use CommandBus;

    /**
     * @var Insight\Users\UserRepository
     */
    private $user;

    /**
     * @var Insight\Users\Forms\UpdatePasswordForm
     */
    private $passwordForm;

    public function __construct(UserRepository $user, UpdatePasswordForm $passwordForm)
    {
        $this->user = $user;
        $this->passwordForm = $passwordForm;
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

    public function forgotPassword()
    {
        return View::make('sessions.forgot_password');
    }

    public function sendResetLink()
    {
        # Response Data Array
        $resp = [];

        // Fields Submitted
        $email = $_POST["email"];


        try
        {
            // Find the user using the user email address
            $user = Sentry::findUserByLogin($email);
            Log::info($user);
            // Get the password reset code
            $token = $user->getResetPasswordCode();
            $data = array('user' => $user,'token' => $token);
            Log::info($data);
            $mail = Mail::send('emails.auth.confirm_reset', $data, function($message) use ($data)
            {
                $message->to($data['user']['email'], $data['user']['first_name'] )->subject('Password Reset Request');
            });
            Log::info($mail);


        }
        catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            //return Redirect::route('forgotpassword')->with('flash_message', 'User was not found.');
            return Response::json('invalid');
        }

        return Response::json('success');
    }

    public function edit($token)
    {

        try
        {
            $user = Sentry::findUserByResetPasswordCode($token);
            return View::make('sessions.change_password', compact(['user', 'token']));
        }
        catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            Flash::error('Reset token is invalid or has expired.');
            return Redirect::to('login');
        }

        return false;

    }
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $user = Sentry::findUserById($id);

        $this->passwordForm->validate(Input::all());

        $user->password = Input::get('password');

        $user->save();

        Flash::success('Your password has been updated.');
        return Redirect::back();
	}

    public function verifyAndUpdate($userId, $token)
    {
        $input = Input::all();

        $this->passwordForm->validate(Input::only('password', 'password_confirmation'));

        try
        {
            $user = Sentry::findUserById($userId);

            // Attempt to reset the user password
            if ($user->attemptResetPassword($token, $input['password']))
            {
                Flash::success('Password successully updated!');
                return Redirect::to('login');
            }
            else
            {
                Flash::error('Password not saved! Please try again.');
                Redirect::back();
            }

        }
        catch (Exception $e)
        {
            Log::info($e->getMessage());
            return $e->getMessage();

        }


    }




}
