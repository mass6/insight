<?php namespace Admin;

use Insight\Permissions\Forms\PermissionForm;
use Insight\Permissions\PermissionRepository;
use Laracasts\Flash\Flash;
use View, Input, Redirect;

class PermissionsController extends AdminBaseController {

    /**
     * @var \Insight\Permissions\PermissionRepository
     */
    protected  $permission;

    /**
     * @var \Insight\Permissions\Forms\PermissionForm
     */
    protected $permissionForm;

    public function __construct(PermissionRepository $permission, PermissionForm $permissionForm)
{
    $this->permission = $permission;
    $this->permissionForm = $permissionForm;
}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$permissions = $this->permission->getPaginated(10);

        return View::make('admin.permissions.index', compact('permissions'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('admin.permissions.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$this->permissionForm->validate(Input::only('name'));

        $permission = $this->permission->create(Input::all());

        Flash::success("Permission \"{$permission->name}\" was successfully created.");

        return Redirect::route('admin.permissions.index');

	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->permission->delete($id);

        Flash::success('Permission was successfuly deleted.');

        return Redirect::back();
	}


}
