@extends($layout)

@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm-5 col-sm-offset-2">
            <h2>Edit Permission Group</h2>
            <br />
        </div>
    </div>

    <div class="row">
            @include('layouts.partials.errors')

            {{ Form::model($group, ['route' => ['admin.groups.update', $group->id], 'method' => 'PATCH', 'class' => 'form-horizontal form-groups-bordered']) }}

                <?php $submit = 'Update'; ?>
                @include('admin.groups._form')

            {{ Form::close() }}
    </div>
</div>
@stop