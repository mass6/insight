@extends($layout)

@section('content')

    <div class="row">
        <div class="col-sm-5 col-sm-offset-2">
            <h2>Edit User: {{ $user->name() }}</h2>
            <br />
        </div>
    </div>
    <div class="row">
        @include('layouts.partials.errors')

        {{ Form::model($user, ['route' => ['admin.users.update', $user->id], 'method' => 'PATCH', 'class' => 'form-horizontal form-groups-bordered']) }}

            <?php $submit = 'Update'; ?>
            @include('admin.users._form')

        {{ Form::close() }}
    </div>

@stop