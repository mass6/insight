@extends($layout)

@section('content')

    <div class="row">
        <div class="col-sm-5 col-sm-offset-2">
            <h2>Add New User</h2>
            <br />
        </div>
    </div>
    <div class="row">
        @include('layouts.partials.errors')

        {{ Form::open(['route' => 'admin.users.store', 'class' => 'form-horizontal form-groups-bordered']) }}

            <?php $submit = 'Submit'; ?>
            @include('admin.users._form')

        {{ Form::close() }}
    </div>

@stop