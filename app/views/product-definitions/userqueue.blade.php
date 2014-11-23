@extends($layout)

@section('content')

<h1>My Requests Queue</h1>
<p>Below are all cataloguing request pending your action.</p>
<br/>
    @if ($products->count())
    <table  id="sample" class="display table table-striped table-bordered">
        <thead>
        <tr>
            <th>Customer</th>
            <th>Code</th>
            <th>Name</th>
            <th>Supplier</th>
            <th>Assigned To</th>
            <th>Status</th>
            <th>Updated</th>
            <th width="130px">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($products as $product)
        <tr>
            <td>{{ $product->customer->name }}</td>
            <td>{{ $product->code }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ isset($product->supplier_id) ? $product->supplier->name : '' }}</td>
            <td>{{ isset($product->assigned_user_id) ? $product->assignedTo->name() : '' }}</td>
            <td>{{ $product->statusName->name }}</td>
            <td>{{ $product->updated_at }}</td>
            <td>{{ link_to_route('catalogue.product-definitions.edit', 'Edit', array($product->id), array('class' => 'btn btn-info pull-left')) }}
                {{ Form::open(array('method' => 'DELETE', 'route' => array('admin.companies.destroy', $product->id))) }}
                {{ Form::submit('Delete', array('class' => 'btn btn-danger pull-right', 'Onclick'=>'return confirm("Are you sure you want to delete this product?")')) }}
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