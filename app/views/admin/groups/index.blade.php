@extends($layout)

@section('content')

<h1>Permission Groups</h1>
<p>{{ link_to_route('admin.groups.create', 'Add new group', null, ['class' => 'btn btn-primary']) }}</p>
@if ($groups->count())
<table  id="sample" class="display table table-striped table-bordered">
    <thead>
    <tr>
        <th>Id</th>
        <th>Group Name</th>
        <th>Permissions</th>
        <th>Options</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($groups as $group)
    <tr>
        <td>{{ $group->id }}</td>
        <td>{{ $group->name }}</td>
        <td>@if (! empty($group->permissions))
            <ul class="list-unstyled">
                @foreach ($group->permissions as $key => $val)
                <li>{{ $key }} : {{ $val ? 'allow' : 'deny' }}</li>
                @endforeach
            </ul>
            @endif
        </td>
        <td>{{ link_to_route('admin.groups.edit', 'Edit', array($group->id), array('class' => 'btn btn-info pull-left')) }}
            {{ Form::open(array('method' => 'DELETE', 'route' => array('admin.groups.destroy', $group->id))) }}
            {{ Form::submit('Delete', array('class' => 'delete btn btn-danger', 'Onclick'=>'return confirm("Are you sure you want to delete this item?")')) }}
            {{ Form::close() }}
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
<div>
    {{ $groups->links() }}
</div>
@else
    <h4>No Groups Defined</h4>
@endif

@stop