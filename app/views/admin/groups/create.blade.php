@extends($layout)

@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm-5 col-sm-offset-2">
            <h2>New Permission Group</h2>
            <br />
        </div>
    </div>

    <div class="row">
            @include('layouts.partials.errors')

            {{ Form::open(['route' => 'admin.groups.store', 'class' => 'form-horizontal form-groups-bordered']) }}

                <?php $submit = 'Submit'; ?>
                @include('admin.groups._form')

            {{ Form::close() }}
    </div>
</div>
@stop