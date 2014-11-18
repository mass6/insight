@extends($layout)

@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm-5 col-sm-offset-2">
            <h2>Edit Product</h2>
            <br />
        </div>
    </div>

    <div class="row">
            @include('layouts.partials.errors')

            {{ Form::model($product, ['route' => ['catalogue.product-definitions.update', $product->id], 'method' => 'PATCH', 'class' => 'form-horizontal form-groups-bordered', 'files' => true]) }}

                <?php $submit = 'Update'; ?>
                @include('product-definitions.' . $form)

            {{ Form::close() }}
    </div>
</div>
@stop