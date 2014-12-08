@extends($layout)

@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <h2>New Product</h2>
            <br />
        </div>
    </div>

    <div class="row col-md-10">
            @include('layouts.partials.errors')
            <hr />

{{--            {{ Form::open(['route' => 'catalogue.product-definitions.store', 'class' => 'form-horizontal form-groups-bordered', 'files' => true]) }}--}}
        @if (!$company_id && $currentUser->hasAccess('cataloguing.products.admin'))
            <div class="well well-sm">
                <h4>Select the customer.</h4>
            </div>
            {{ Form::open(['route' => 'catalogue.product-definitions.create', 'method' => 'get']) }}

                <div class="col-md-6">


                    <label class="control-label" for="supplier_id"><strong>Action</strong></label>
                    <div class="input-group">
                        {{ Form::select('company_id', $companies, null, ['class'=>'form-control', 'id'=>'company_id', 'data-validate' => 'required']) }}

                        <span class="input-group-btn">
                            <button class="btn btn-primary" type="submit">Go!</button>
                        </span>

                        <div class="" style="margin-left:20px;">
                            {{ link_to_route('catalogue.product-definitions.index', 'Cancel', null, array('class'=>'btn btn-danger pull-left')) }}
                        </div>

                    </div>

                </div>

        @else
            <div class="well well-sm">
                <h4>Please fill the product details to create a new product cataloguing request.</h4>
            </div>
            {{ Form::open(['route' => 'catalogue.product-definitions.store', 'id' => 'rootwizard-2', 'name' => 'rootwizard-2', 'class' => 'form-wizard validate', 'files' => true]) }}

                <?php $submit = 'Submit'; ?>

                @include('product-definitions.partials._form-wizard-new')
        @endif
            {{ Form::close() }}
    </div>
</div>
@stop