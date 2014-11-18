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
            <hr />

            <div class="well well-sm">
            	<h4>Please fill the product details to create a new product cataloguing request.</h4>
            </div>

            {{--{{ Form::open(['route' => 'catalogue.product-definitions.store', 'class' => 'form-horizontal form-groups-bordered', 'files' => true]) }}--}}
            {{ Form::open(['route' => 'catalogue.product-definitions.store', 'id' => 'rootwizard-2', 'name' => 'rootwizard-2', 'class' => 'form-wizard validate', 'files' => true]) }}

                <?php $submit = 'Submit'; ?>
                @include('product-definitions._form-wizard')

            {{ Form::close() }}
    </div>
</div>
@stop