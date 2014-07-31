@extends($layout)

@section('content')

<h1>Permissions</h1>
<p>{{ link_to_route('admin.permissions.create', 'Add new permission', null, ['class' => 'btn btn-primary']) }}</p>
@if ($permissions->count())
<table  id="sample" class="display table table-striped table-bordered">
    <thead>
    <tr>
        <th>Permission Name</th>
        <th>Options</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($permissions as $permission)
    <tr>
        <td>{{ $permission->name }}</td>
        <td>{{ link_to_route('admin.users.edit', 'Edit', array($permission->id), array('class' => 'btn btn-info pull-left')) }}
            {{ Form::open(array('method' => 'DELETE', 'route' => array('admin.permissions.destroy', $permission->id))) }}
            {{ Form::submit('Delete', array('class' => 'btn btn-danger', 'Onclick'=>'return confirm("Are you sure you want to delete this item?")')) }}
            {{ Form::close() }}
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
<div>
    {{ $permissions->links() }}
</div>
@else
    <h4>No Permission Defined</h4>
@endif

@stop