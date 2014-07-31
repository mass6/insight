@extends($layout)

@section('content')

<h1>All Users</h1>
    <p>{{ link_to_route('admin.users.create', 'Add new user', null, ['class' => 'btn btn-primary']) }}</p>
    @if ($users->count())
    <table  id="sample" class="display table table-striped table-bordered">
        <thead>
        <tr>
            <th>Id</th>
            <th>Email</th>
            <th>Name</th>
            <th>Company</th>
            <th>Groups</th>
            <th>Permissions</th>
            <th>Options</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->name() }}</td>
            <td>{{ $user->company }}</td>
            <td>
                <ul class="list-unstyled">
                    @foreach ($user->groups as $group)
                        <li>{{ $group['name'] }}</li>
                    @endforeach
                </ul>

            </td>
            <td>@if (! empty($user->permissions))
                    <ul class="list-unstyled">
                    @foreach ($user->permissions as $key => $val)
                        <li>{{ $key }} : {{ $val === 1 ? 'allow' : 'deny' }}</li>
                    @endforeach
                    </ul>
                @endif
            </td>
            <td>{{ link_to_route('admin.users.show', 'View', array($user->id), array('class' => 'btn btn-info pull-left')) }}
                {{ Form::open(array('method' => 'DELETE', 'route' => array('admin.users.destroy', $user->id))) }}
                {{ Form::submit('Delete', array('class' => 'btn btn-danger', 'Onclick'=>'return confirm("Are you sure you want to delete this user?")')) }}
                {{ Form::close() }}
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <div>
        {{ $users->links() }}
    </div>
    @endif

@stop