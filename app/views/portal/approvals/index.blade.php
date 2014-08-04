@extends($layout)

@section('links')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('js/datatables/css/jquery.dataTables.css') }}">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/plug-ins/28e7751dbec/integration/bootstrap/3/dataTables.bootstrap.css">
    <style>
        table.users, table.addresses {border:1px solid #dddddd;}
        .users td, .addresses td {border:none;}
        td.details-control1, td.details-control2 {
            background: url('{{ URL::asset("js/datatables/resources/details_open.png") }}') no-repeat center center;
            cursor: pointer;
        }
        tr.shown1 td.details-control1, tr.shown2 td.details-control2 {
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
        var reportname = "<?php echo $reportName; ?>";
    </script>

    <script class="init" type="text/javascript">

        $(document).ready(function() {

            var table = $('#datatable').DataTable({
                "ajax": {
                    "url" : "/portal/ajax/OrdersPendingApproval",
                    "dataSrc": ""
                },
                "deferRender": true,
                "columns": [
                    { "data": "entity_id", "visible":false },
                    { "data": "weborder" },
                    { "data": "total" },
                    { "data": "customer" },
                    { "data": "ordered_by" },
                    { "data": "contract" },
                    { "data": "created_at" },
                    { "data": "lead_time_hours" },
                    { "data": "total_lead_time_hours" },
                    { "data": "current_approver" },
                    { "data": "last_approver"},
                    {     // fifth column (Edit link)
                        "bSearchable": false,
                        "bSortable": false,
                        "mRender": function (data, type, full)
                        {
                            var id = full['entity_id']; //row id in the first column
                            return "<a href='/portal/orders/details/"+id+"' class='btn btn-primary'>View</a>";
                        }
                    }
                ],
                "order": [[7, 'desc']],
                "sPaginationType": "bootstrap",
                "pagingType": "full_numbers",
                "sDom": "<'row'<'col-xs-6 col-left'l><'col-xs-6 col-right'<'export-data'T>f>r>t<'row'<'col-xs-6 col-left'i><'col-xs-6 col-right'p>>",
                "oTableTools": {
                    "sSwfPath": "{{ URL::asset('js/datatables/copy_csv_xls_pdf.swf') }}",
                    "aButtons": [
                        "print",
                        {
                            "sExtends": "pdf",
                            "sFileName": "orders_pending_approval.pdf",
                            "mColumns": [ 1,2,3,4,5,6 ]
                        },
                        {
                            "sExtends": "csv",
                            "sFileName": "orders_pending_approval.csv",
                            "mColumns": [ 2,3,4,5,6]
                        },
                        {
                            "sExtends": "xls",
                            "sFileName": "orders_pending_approval.xls",
                            "mColumns": [ 1,2,3,4,5,6]
                        }
                    ]
                }
            });



        });
    </script>

@stop

@section('content')

<h2>Orders Pending Approval</h2>

<table id="datatable" class="table table-bordered datatable">
    <thead>
    <tr>
        <th>Id</th>
        <th>Weborder</th>
        <th>Total</th>
        <th>Customer</th>
        <th>Ordered By</th>
        <th>Contract</th>
        <th>Ordered On</th>
        <th>Current Lead Time (hrs)</th>
        <th>Total Lead Time (hrs)</th>
        <th>Current Approver</th>
        <th>Last Approver</th>
        <th>Options</th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <th>Id</th>
        <th>Weborder</th>
        <th>Total</th>
        <th>Customer</th>
        <th>Ordered By</th>
        <th>Contract</th>
        <th>Ordered On</th>
        <th>Current Lead Time (hrs)</th>
        <th>Total Lead Time (hrs)</th>
        <th>Current Approver</th>
        <th>Last Approver</th>
        <th>Options</th>
    </tr>
    </tfoot>

</table>


@include('portal.partials._datatables')

@stop