@extends($layout)

@section('links')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('js/datatables/css/jquery.dataTables.css') }}">
    {{--<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/plug-ins/28e7751dbec/integration/bootstrap/3/dataTables.bootstrap.css">--}}

<script class="init" type="text/javascript">
    $(document).ready(function() {
        $('#datatable').dataTable({
            "sPaginationType": "bootstrap",
            "sDom": "<'row'<'col-xs-6 col-left'l><'col-xs-6 col-right'<'export-data'T>f>r>t<'row'<'col-xs-6 col-left'i><'col-xs-6 col-right'p>>",
            "order": [[0, 'desc']],
            "oTableTools": {
                "sSwfPath": "js/datatables/copy_csv_xls_pdf.swf",
                "aButtons": [
                    "print",
                    {
                        "sExtends": "pdf",
                        "sFileName": "completed-product-cataloguing-requests.pdf"
                    },
                    {
                        "sExtends": "csv",
                        "sFileName": "completed-product-cataloguing-requests.csv"
                    },
                    {
                        "sExtends": "xls",
                        "sFileName": "completed-product-cataloguing-requests.xls"
                    }
                ]
            }
        });
    });
</script>

@stop

@section('content')

<a href="{{URL::route('catalogue.product-definitions.create')}}" class="pull-right">
    <button type="button" class="btn btn-info btn-icon icon-left">
        New Request
        <i class="entypo-plus"></i>
    </button>
</a>

<h1>Completed Product Cataloguing Requests</h1>
    <p class="text text-info">Below are all <strong>completed</strong> cataloguing requests.</p>
    <br/>
    @if ($products->count())
    <table id="datatable" class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Customer</th>
            <th>Code</th>
            <th>Name</th>
            <th>Supplier</th>
            <th>Assigned To</th>
            <th>Status</th>
            <th>Attributes</th>
            <th>Updated</th>
            <th width="90px">Options</th>
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
            <td>
                <div class="progress progress-striped">
                    <div class="progress-bar progress-bar-{{$product->attributeCompleteness()['label']}}" role="progressbar" aria-valuenow="{{ $product->attributeCompleteness()['percentage'] }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $product->attributeCompleteness()['percentage'] }}%">
                        <span class="sr-only">20% Complete (success)</span>
                    </div>
                </div>
            </td>
            <td>{{ $product->updated_at }}</td>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-primary">Options</button>
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                        <i class="caret"></i>
                    </button>

                    <ul class="dropdown-menu dropdown-blue" role="menu">
                        <li><a href="{{URL::route('catalogue.product-definitions.show', ['id' => $product->id])}}"><i class="entypo-right"></i>View</a>
                        </li>
                    </ul>
                </div>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <div>
        {{ $products->links() }}
    </div>
    @endif


@include('portal.partials._datatables')

@stop