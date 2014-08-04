@extends($layout)

@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm-5 col-sm-offset-2">
            <h2>{{ $group->name }}</h2>
            <br />
        </div>
    </div>

    <div class="row">

        {{ Form::open(['class' => 'form-horizontal form-groups-bordered']) }}

        <!-- Group Name -->
        <div class="form-group">
            {{ Form::label('name', 'name:', ['class' => 'col-sm-3 control-label', 'disabled']) }}
            <div class="col-sm-5">
                {{ Form::text('name', null, ['class' => 'form-control']) }}
            </div>
        </div>

        <!-- Group Name -->
        <div class="form-group">
            {{ Form::label('permissions', 'Group Permissions:', ['class' => 'col-sm-3 control-label', 'disabled']) }}
            <div class="col-sm-5">
                {{ Form::textarea('permissions', $group->serialedPermissions(), ['class' => 'form-control']) }}
            </div>
        </div>


        {{ Form::close() }}

        <br />

        <!-- Buttons -->
        <div class="form-group col-sm-offset-2">
            {{ link_to_route('admin.groups.edit', 'Edit', [$group->id], ['class' => 'btn btn-primary']) }}
            {{ link_to_route('admin.groups.index', 'Cancel', null, array('class'=>'btn btn-warning')) }}
        </div>
    </div>
</div>
@stop
