@extends($layout)

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Editing: <small>{{$product->name}} [{{ $product->code }}]</small></h2>
        </div>
    </div>

    <div class="row">
            @include('layouts.partials.errors')

            {{ Form::model($product, ['route' => ['catalogue.product-definitions.update', $product->id], 'method' => 'PATCH', 'id' => 'rootwizard-2', 'name' => 'rootwizard-2', 'class' => 'form-wizard validate', 'files' => true]) }}

                <?php $submit = 'Update'; ?>
                @include('product-definitions.' . $form)

            {{ Form::close() }}
    </div>
</div>
@stop