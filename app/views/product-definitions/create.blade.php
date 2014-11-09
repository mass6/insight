@extends($layout)

@section('links')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('js/bootstrap-tour/build/css/bootstrap-tour.min.css') }}">
@stop

@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <h2>New Product</h2>
            <br />
        </div>
    </div>

    <div class="row">
            @include('layouts.partials.errors')

            {{ Form::open(['route' => 'catalogue.product-definitions.store', 'class' => 'form-horizontal form-groups-bordered', 'files' => true]) }}

                <?php $submit = 'Submit'; ?>
                @include('product-definitions._form')

            {{ Form::close() }}
    </div>
</div>
@stop