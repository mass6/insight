@extends($layout)

@section('links')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('js/datatables/css/jquery.dataTables.css') }}">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/plug-ins/28e7751dbec/integration/bootstrap/3/dataTables.bootstrap.css">
    <style>
        table.users, table.addresses {border:1px solid #dddddd;}
        .users td, .addresses td {border:none;}
        td.details-control1  {
            background: url('{{ URL::asset("js/datatables/resources/details_open.png") }}') no-repeat center center;
            cursor: pointer;
        }
        tr.shown1 td.details-control1 {
            background: url('{{ URL::asset("js/datatables/resources/details_close.png") }}') no-repeat center center;
        }
        tr.row-header {background-color: #DDDDDD !important;}
        td.column-header {width: 100% !important;color:#464646}
        .users tr {border-bottom: 1px solid #ddd;}
        td.col-label {color:#464646;}
        td.col-value {border-right:1px solid #DDDDDD;}
        table.addresses tr td.col-label {text-decoration: underline;}
    </style>
    <script>
        var reportname = "<?php if (isset($group)) { echo $reportName . '/' . $group; } else echo $reportName; ?>";
    </script>

    <script class="init" type="text/javascript">

        /* Formatting function for row details - modify as you need */
        function format ( d ) {
            // `d` is the original data object for the row
            return '<table class="addresses"  cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
                '<tr class="row-header">'+
                '<td class="col-label">Ordered By</td>'+
                '<td class="col-label">Ship To</td>'+
                '<td class="col-label">Approved By</td>'+
                '<td class="col-label">Approved At</td>'+
                '</tr>'+
                '<tr>'+
                '<td class="col-value">'+d.ordered_by+'</td>'+
                '<td class="col-value">'+d.ship_to+'</td>'+
                '<td class="col-value">'+d.approved_by+'</td>'+
                '<td class="col-value">'+d.approved_at+'</td>'+
                '</tr>'+
                '</table>';
        }

        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        $(document).ready(function() {
            var table = $('#datatable').DataTable({
                "ajax": {
                    "url" : "/portal/ajax/"+reportname,
                    "dataSrc": ""
                },
                "deferRender": true,
                "aoColumns": [
                    {
                        "class":          'details-control1',
                        "orderable":      false,
                        "data":           null,
                        "defaultContent": ''
                    },
                    { "data": "increment_id" },
                    { "data": "created_at" },
                    { "data": "status" },
                    { "data": "customer" },
                    { "data": "contract_display_name" },
                    { "data": "grand_total" },
                    {     // fifth column (Edit link)
                        "bSearchable": false,
                        "mRender": function (data, type, full)
                        {
                            var id = full['entity_id']; //row id in the first column
                            return "<a href='/portal/orders/details/"+id+"' class='btn btn-primary'>View</a>";
                        }
                    },
                    { "data": "ordered_by", "visible":false },
                    { "data": "ship_to", "visible":false },
                    { "data": "approved_by", "visible":false },
                    { "data": "approved_at", "visible":false },
                    { "data": "week", "visible":false },
                    { "data": "month", "visible":false },
                    { "data": "quarter", "visible":false }
                ],
                "columnDefs": [ {
                    "targets": 6,
                    "createdCell": function (td, cellData, rowData, row, col) {
                        $(td).css('color', '#4379C9');
                        $(td).css('font-weight', 'bold');
                        $(td).css('width', '7%');
                        $(td).css('text-align', 'right');
                        }
                    }, {
                    "targets": 7,
                    "createdCell": function (td, cellData, rowData, row, col) {
                        $(td).css('width', '10%');
                    }
                }
                ],
                "footerCallback": function ( row, data, start, end, display ) {
                    var api = this.api(), data;

                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '')*1 :
                            typeof i === 'number' ?
                                i : 0;
                    };

                    // Total over all pages
                    data = api.column( 6 ).data();
                    total = data.length ?
                        data.reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        } ) :
                        0;

                    // Total over this page
                    data = api.column( 6, { page: 'current'} ).data();
                    pageTotal = data.length ?
                        data.reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        } ) :
                        0;

                    console.log(pageTotal);
                    // Update footer
                    $( api.column( 6 ).footer() ).html(
                        'Showing AED '+ numberWithCommas(Math.round(pageTotal*100)/100) +
                            '<br/> of  AED '+ numberWithCommas(Math.round(total*100)/100) +' Total'
                    );
                },
                "order": [[2, 'desc']],
                "sPaginationType": "bootstrap",
                "pagingType": "full_numbers",
                "sDom": "<'row'<'col-xs-6 col-left'l><'col-xs-6 col-right'<'export-data'T>f>r>t<'row'<'col-xs-6 col-left'i><'col-xs-6 col-right'p>>",
                "oTableTools": {

                    "sSwfPath": "{{ URL::asset('js/datatables/copy_csv_xls_pdf.swf') }}",
                    "aButtons": [
                        "print",
                        {
                            "sExtends": "pdf",
                            "sFileName": "orders.pdf",
                            "mColumns": [ 1,2,4,5,6 ]
                        },
                        {
                            "sExtends": "csv",
                            "sFileName": "orders.csv",
                            "mColumns": [ 1,2,3,4,5,6 ]
                        },
                        {
                            "sExtends": "xls",
                            "sFileName": "orders.xls",
                            "mColumns": [ 1,2,3,4,5,6 ]
                        }
                    ]
                }
            });

            // Add event listener for opening and closing details
            $('#datatable tbody').on('click', 'td.details-control1', function () {
                console.log('clicked');
                var tr = $(this).closest('tr');
                var row = table.row( tr );

                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown1');
                }
                else {
                    // Open this row
                    row.child( format(row.data()) ).show();
                    tr.addClass('shown1');
                }
            } );


        });
    </script>

@stop

@section('content')

<h2>{{ isset($heading) ? $heading : 'Orders: ' }} {{isset($group) ? "<span class='text text-info'>(" . $group . ")</span>" : ''}}</h2>

@if (isset($customers))
    <div id="customer-filter">
        <div class="clearfix">

            <div class="btn-group">
                <button type="button" class="btn btn-blue">{{isset($group)? $group : 'Customer'}}</button>
                <button type="button" class="btn btn-blue dropdown-toggle" data-toggle="dropdown">
                    <i class="entypo-down"></i>
                </button>
                <ul class="dropdown-menu dropdown-blue" role="menu">
                @foreach($customers as $customer)
                    @if(isset($group))
                        @if($group !== $customer['name'])
                            <li>{{link_to('portal/orders/' . $period . '/' . $customer['name'], $customer['name'])}}</li>
                        @endif
                    @else
                        <li>{{link_to('portal/orders/' . $period . '/' . $customer['name'], $customer['name'])}}</li>
                    @endif
                @endforeach
                    <li class="divider"></li>
                    <li>{{link_to('portal/orders/' . $period, "View All")}}</li>
                </ul>
            </div>

        </div>
        <br/>
    </div>
    <div class="clearfix"></div>
@endif

<table id="datatable" class="table table-bordered datatable hover order-column">
    <thead>
    <tr>
        <th>Details</th>
        <th>Weborder No.</th>
        <th>Created</th>
        <th>Status</th>
        <th>Customer</th>
        <th>Contract</th>
        <th>Total</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <th colspan="6" style="text-align:right">Total:</th>
        <th colspan="2"></th>
    </tr>
    </tfoot>

</table>

@include('portal.partials._datatables')

@stop