@extends($layout)

@section('content')

    <div class="row">
        <div class="col-sm-5 col-sm-offset-2">
            <h2>Add New Permission</h2>
            <br />
        </div>
    </div>
    <div class="row">
        @include('layouts.partials.errors')

        {{ Form::open(['route' => 'admin.permissions.store', 'class' => 'form-horizontal form-groups-bordered']) }}

            <?php $submit = 'Submit'; ?>
            @include('admin.permissions._form')

        {{ Form::close() }}
    </div>

@stop