<?php namespace Admin;

use Insight\Core\CommandBus;
use Insight\Permissions\AddNewGroupCommand;
use Insight\Permissions\DeleteGroupCommand;
use Insight\Permissions\Forms\GroupForm;
use Insight\Permissions\GroupRepository;
use Illuminate\Support\Facades\Redirect;
use Insight\Permissions\PermissionRepository;
use Insight\Permissions\UpdateGroupCommand;
use Laracasts\Flash\Flash;
use View, Input;


class GroupsController extends AdminBaseController {

    use CommandBus;


    /**
     * @var \Insight\Permissions\GroupRepository
     */
    protected $group;

    /**
     * @var \Insight\Permissions\PermissionRepository
     */
    protected  $permission;

    /**
     * @var \Insight\Permissions\Forms\GroupForm
     */
    protected $groupForm;

    public function __construct(GroupRepository $group, PermissionRepository $permission, GroupForm $groupForm)
    {

        $this->group = $group;
        $this->groupForm = $groupForm;
        $this->permission = $permission;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $groups = $this->group->getPaginated(10);

        return View::make('admin.groups.index', compact('groups'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $permissions = $this->permission->getList();
		return View::make('admin.groups.create', compact('permissions'));
    }


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $name = Input::get('name');
        $permissions = Input::get('permissions', []);

		$this->groupForm->validate(compact('name', 'user'));

        $this->execute(new AddNewGroupCommand($name, $permissions));

        Flash::message('Group was successfully created.');
        return Redirect::route('admin.groups.index');
    }


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$group = $this->group->find($id);

        return View::make('admin.groups.show', compact('group'));
    }

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $group = $this->group->find($id);
        $allPermissions = $this->permission->getList();
        $groupPermissions = $this->group->getAssignedPermissions($group);
        $permissions = array_diff($allPermissions, $groupPermissions);

        return View::make('admin.groups.edit', compact('group', 'permissions', 'groupPermissions'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $name = Input::get('name');
        $permissions = Input::get('permissions', []);

		$this->groupForm->validate(compact('id', 'name', 'permissions'));

        $this->execute(new UpdateGroupCommand($id, $name, $permissions));

        Flash::success('Group was successfully updated.');
        return Redirect::route('admin.groups.index');

	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $group = $this->group->find($id);

        $this->execute(new DeleteGroupCommand($group));

        Flash::success('Group was successfully deleted.');
        return Redirect::route('admin.groups.index');
	}


}
