<?php namespace Admin;

use Insight\Core\CommandBus;
use Insight\Permissions\GroupRepository;
use Insight\Permissions\PermissionRepository;
use Insight\Users\AddNewUserCommand;
use Insight\Users\DeleteUserCommand;
use Insight\Users\Forms\NewUserForm;
use Insight\Users\Forms\UpdateUserForm;
use Insight\Users\UpdateUserCommand;
use Insight\Users\UserRepositoryInterface;
use Laracasts\Flash\Flash;
use View, Input, Redirect;

class UsersController extends AdminBaseController {

    use CommandBus;

    /**
     * @var \Insight\Users\UserRepository
     */
    private $user;

    /**
     * @var \Insight\Users\Forms\NewUserForm
     */
    private $newUserForm;

    /**
     * @var \Insight\Users\Forms\UpdateUserForm
     */
    private $updateUserForm;

    /**
     * @var \Insight\Permissions\GroupRepository
     */
    private $group;

    /**
     * @var \Insight\Permissions\PermissionRepository
     */
    private $permission;

    public function __construct(UserRepositoryInterface $user, GroupRepository $group, PermissionRepository $permission,
                                NewUserForm $newUserForm, UpdateUserForm $updateUserForm)
    {
        $this->user = $user;
        $this->newUserForm = $newUserForm;
        $this->updateUserForm = $updateUserForm;
        $this->group = $group;
        $this->permission = $permission;
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// get all users
        $users = $this->user->getPaginated(10);

        return View::make('admin.users.index', compact('users'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $permissions = $this->permission->getList();
        $allowedPermissionsDiff = $permissions;
        $deniedPermissionsDiff = $permissions;
        $groups = $this->group->getList();

        return View::make('admin.users.create', compact(
            'allowedPermissionsDiff', 'deniedPermissionsDiff', 'groups'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        // Validate form
        $this->newUserForm->validate(Input::all());

        extract(Input::only('first_name', 'last_name', 'email', 'password', 'company', 'send_email'));
        $permissionsAllowed = Input::get('permissions_allowed', []);
        $permissionsDenied = Input::get('permissions_denied', []);
        $groups = Input::get('groups', []);

        // Create the new user
        try
        {
            $this->execute(new AddNewUserCommand($first_name, $last_name, $email, $password, $company,
                $send_email, $permissionsAllowed, $permissionsDenied, $groups));
        }
        catch (\Exception $e)
        {
            Flash::error($e->getMessage());
            return Redirect::back();
        }

        Flash::success('User was successfully created.');
        return Redirect::route('admin.users.index');

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

        return View::make('admin.users.show', compact('user'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $user = $this->user->find($id);

        $allPermissions = $this->permission->getList();
        $allowedPermissions = $this->user->getAllowedPermissions($user);
        $deniedPermissions = $this->user->getDeniedPermissions($user);

        $allowedPermissionsDiff = array_diff($allPermissions, $allowedPermissions);
        $deniedPermissionsDiff = array_diff($allPermissions, $deniedPermissions);

        $allGroups = $this->group->getList();
        $userGroups = $this->user->getAssignedGroups($user);
        $groups = array_diff($allGroups, $userGroups);

        return View::make('admin.users.edit', compact(
            'user', 'allowedPermissions', 'allowedPermissionsDiff', 'deniedPermissions', 'deniedPermissionsDiff', 'groups', 'userGroups'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        //return Input::all();
        // Validate form
        $this->updateUserForm->validate(Input::all());

        extract(Input::only('first_name', 'last_name', 'email', 'password', 'company'));
        $permissionsAllowed = Input::get('permissions_allowed', []);
        $permissionsDenied = Input::get('permissions_denied', []);
        $groups = Input::get('groups', []);

        // Update the new user
        try
        {
            $this->execute(new UpdateUserCommand($id, $first_name, $last_name, $email, $password, $company, $permissionsAllowed, $permissionsDenied, $groups));
        }
        catch (\Exception $e)
        {
            Flash::error($e->getMessage());
            return Redirect::back();
        }

        Flash::success('User was successfully updated.');
        return Redirect::route('admin.users.index');

    }


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $user = $this->user->find($id);
        //get_class($user);
		$this->execute(new DeleteUserCommand($user));

        Flash::success('User was successfully deleted.');
        return Redirect::route('admin.users.index');
	}


}
