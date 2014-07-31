<?php

use Illuminate\Support\Facades\Input;
use Insight\Core\CommandBus;
use Insight\Users\CreateUserProfileCommand;
use Insight\Users\Forms\ProfileForm;
use Insight\Users\UpdateProfileCommand;
use Insight\Users\UserRepository;

class ProfilesController extends \BaseController {

    use CommandBus;

    /**
     * @var Insight\Users\UserRepository
     */
    protected $user;

    /**
     * @var Insight\Users\Forms\ProfileForm
     */
    protected $profileForm;

    public function __construct(UserRepository $user, ProfileForm $profileForm)
    {
        $this->user = $user;
        $this->profileForm = $profileForm;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $user = $this->user->find($id);

        if (! $user->profile){
            $this->execute(new CreateUserProfileCommand($user));
        }

        return View::make('profiles.show', compact('user'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $this->profileForm->validate(Input::all());

        $user = $this->user->find($id);
        $this->execute(new UpdateProfileCommand($user, Input::all()));

        Flash::success('Profile updated.');
        return Redirect::refresh();

	}



}
