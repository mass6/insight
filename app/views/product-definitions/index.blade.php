@extends($layout)

@section('content')

<h1>Product Definitions</h1>
    <p>{{ link_to_route('catalogue.product-definitions.create', 'Add new product', null, ['class' => 'btn btn-primary']) }}</p>
    @if ($products->count())
    <table  id="sample" class="display table table-striped table-bordered">
        <thead>
        <tr>
            <th>Code</th>
            <th>Name</th>
            <th>Category</th>
            <th>UOM</th>
            <th>Supplier</th>
            <th>Assigned To</th>
            <th>Status</th>
            <th>Updated</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($products as $product)
        <tr>
            <td>{{ $product->code }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->category }}</td>
            <td>{{ $product->uom }}</td>
            <td>{{ isset($product->supplier_id) ? $product->supplier->name : '' }}</td>
            <td>{{ isset($product->assigned_user_id) ? $product->assignedTo->name() : '' }}</td>
            <td>{{ $product->statusName->name }}</td>
            <td>{{ $product->updated_at }}</td>
            <td>{{ link_to_route('catalogue.product-definitions.edit', 'Edit', array($product->id), array('class' => 'btn btn-info pull-left')) }}
                {{ Form::open(array('method' => 'DELETE', 'route' => array('admin.companies.destroy', $product->id))) }}
                {{ Form::submit('Delete', array('class' => 'btn btn-danger', 'Onclick'=>'return confirm("Are you sure you want to delete this product?")')) }}
                {{ Form::close() }}
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <div>
        {{ $products->links() }}
    </div>
    @endif

@stop