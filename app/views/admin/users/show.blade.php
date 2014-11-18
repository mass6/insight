@extends($layout)

@section('content')

<div class="row">
    <div class="col-sm-5 col-sm-offset-2">
        <h2>{{ $user->name() }}</h2>
        <br />
    </div>
</div>
<div class="row">
    {{ Form::open(['class'=>'form-horizontal form-groups-bordered']) }}
        <!-- First_name -->
        <div class="form-group">
            {{ Form::label('first_name', 'First Name:', ['class' => 'col-sm-3 control-label']) }}
            <div class="col-sm-5">
                {{ Form::text('first_name', $user->first_name, ['class' => 'form-control', 'disabled' => 'disabled']) }}
            </div>
        </div>

        <!-- Last Name -->
        <div class="form-group">
            {{ Form::label('last_name', 'Last Name:', ['class' => 'col-sm-3 control-label']) }}
            <div class="col-sm-5">
                {{ Form::text('last_name', $user->last_name, ['class' => 'form-control', 'disabled' => 'disabled']) }}
            </div>
        </div>

        <!-- email -->
        <div class="form-group">
            {{ Form::label('email', 'Email:', ['class' => 'col-sm-3 control-label']) }}
            <div class="col-sm-5">
                {{ Form::text('email', $user->email, ['class' => 'form-control', 'disabled' => 'disabled']) }}
            </div>
        </div>

        <!-- Company -->
        <div class="form-group">
            {{ Form::label('company', 'Company:', ['class' => 'col-sm-3 control-label']) }}
            <div class="col-sm-5">
                {{ Form::text('company', $user->company->name, ['class' => 'form-control', 'disabled' => 'disabled']) }}
            </div>
        </div>

        <!-- Groups -->
        <div class="form-group">
            {{ Form::label('groups', 'Groups:', ['class' => 'col-sm-3 control-label']) }}
            <div class="col-sm-5">
                {{ Form::text('company', json_encode($user->getAssignedGroups()), ['class' => 'form-control', 'disabled' => 'disabled']) }}
            </div>
        </div>



    {{ Form::close() }}

    <br />

    <!-- Buttons -->
    <div class="form-group col-sm-offset-2">
        {{ link_to_route('admin.users.edit', 'Edit', [$user->id], ['class' => 'btn btn-primary']) }}
        {{ link_to_route('admin.users.index', 'Cancel', null, array('class'=>'btn btn-warning')) }}
    </div>



</div>
@stop