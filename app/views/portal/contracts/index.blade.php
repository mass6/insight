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

    /* Formatting function for row details - modify as you need */
    function format ( d ) {
        // `d` is the original data object for the row
        return '<table class="users" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
            '<tr class="row-header">'+
            '<td class="column-header" colspan="11">Assigned Users</td>'+
            '</tr>'+
            '<tr">'+
            '<td class="col-label">User 1:</td>'+
            '<td class="col-value">'+d.user1+'</td>'+
            '<td class="col-label">User 6:</td>'+
            '<td class="col-value">'+d.user6+'</td>'+
            '<td class="col-label">User 11:</td>'+
            '<td class="col-value">'+d.user11+'</td>'+
            '<td class="col-label">User 16:</td>'+
            '<td class="col-value">'+d.user16+'</td>'+
            '</tr>'+
            '<tr>'+
            '<td class="col-label">User 2:</td>'+
            '<td class="col-value">'+d.user2+'</td>'+
            '<td class="col-label">User 7:</td>'+
            '<td class="col-value">'+d.user7+'</td>'+
            '<td class="col-label">User 12:</td>'+
            '<td class="col-value">'+d.user12+'</td>'+
            '<td class="col-label">User 17:</td>'+
            '<td class="col-value">'+d.user17+'</td>'+
            '</tr>'+
            '<tr>'+
            '<td class="col-label">User 3:</td>'+
            '<td class="col-value">'+d.user3+'</td>'+
            '<td class="col-label">User 8:</td>'+
            '<td class="col-value">'+d.user8+'</td>'+
            '<td class="col-label">User 13:</td>'+
            '<td class="col-value">'+d.user13+'</td>'+
            '<td class="col-label">User 18:</td>'+
            '<td class="col-value">'+d.user18+'</td>'+
            '</tr>'+
            '<tr>'+
            '<td class="col-label">User 4:</td>'+
            '<td class="col-value">'+d.user4+'</td>'+
            '<td class="col-label">User 9:</td>'+
            '<td class="col-value">'+d.user9+'</td>'+
            '<td class="col-label">User 14:</td>'+
            '<td class="col-value">'+d.user14+'</td>'+
            '<td class="col-label">User 19:</td>'+
            '<td class="col-value">'+d.user19+'</td>'+
            '</tr>'+
            '<tr>'+
            '<td class="col-label">User 5:</td>'+
            '<td class="col-value">'+d.user5+'</td>'+
            '<td class="col-label">User 10:</td>'+
            '<td class="col-value">'+d.user10+'</td>'+
            '<td class="col-label">User 15:</td>'+
            '<td class="col-value">'+d.user15+'</td>'+
            '<td class="col-label">User 20:</td>'+
            '<td class="col-value">'+d.user20+'</td>'+
            '</tr>'+
            '</table>';
    }

    /* Formatting function for row details - modify as you need */
    function format2 ( d ) {
        // `d` is the original data object for the row
        return '<table class="addresses"  cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
            '<tr class="row-header">'+
            '<td class="column-header" colspan="11">Shipping Addresses</td>'+
            '</tr>'+
            '<tr>'+
            '<td class="col-label">No</td>'+
            '<td class="col-label">Name</td>'+
            '<td class="col-label">Street</td>'+
            '<td class="col-label">Street L2</td>'+
            '<td class="col-label">City</td>'+
            '<td class="col-label">Country</td>'+
            '<td class="col-label">Zip</td>'+
            '</tr>'+
            '<tr>'+
            '<td>1:</td>'+
            '<td>'+d.name_ship1+'</td>'+
            '<td>'+d.street_ship1+'</td>'+
            '<td>'+d.street1_ship1+'</td>'+
            '<td>'+d.city_ship1+'</td>'+
            '<td>'+d.country_ship1+'</td>'+
            '<td>'+d.zip_ship1+'</td>'+
            '</tr>'+
            '<tr>'+
            '<td>2:</td>'+
            '<td>'+d.name_ship2+'</td>'+
            '<td>'+d.street_ship2+'</td>'+
            '<td>'+d.street1_ship2+'</td>'+
            '<td>'+d.city_ship2+'</td>'+
            '<td>'+d.country_ship2+'</td>'+
            '<td>'+d.zip_ship2+'</td>'+
            '</tr>'+
            '<tr>'+
            '<td>3:</td>'+
            '<td>'+d.name_ship3+'</td>'+
            '<td>'+d.street_ship3+'</td>'+
            '<td>'+d.street1_ship3+'</td>'+
            '<td>'+d.city_ship3+'</td>'+
            '<td>'+d.country_ship3+'</td>'+
            '<td>'+d.zip_ship3+'</td>'+
            '</tr>'+
            '<tr>'+
            '<td>4:</td>'+
            '<td>'+d.name_ship4+'</td>'+
            '<td>'+d.street_ship4+'</td>'+
            '<td>'+d.street1_ship4+'</td>'+
            '<td>'+d.city_ship4+'</td>'+
            '<td>'+d.country_ship4+'</td>'+
            '<td>'+d.zip_ship4+'</td>'+
            '</tr>'+
            '<tr>'+
            '<td>5:</td>'+
            '<td>'+d.name_ship5+'</td>'+
            '<td>'+d.street_ship5+'</td>'+
            '<td>'+d.street1_ship5+'</td>'+
            '<td>'+d.city_ship5+'</td>'+
            '<td>'+d.country_ship5+'</td>'+
            '<td>'+d.zip_ship5+'</td>'+
            '</tr>'+
            '</table>';
    }


    $(document).ready(function() {

        var table = $('#datatable').DataTable({
            "ajax": {
                "url" : "/portal/ajax/contracts",
                "dataSrc": ""
            },
            "deferRender": true,
            "columns": [
                {
                    "class":          'details-control1',
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": ''
                },
                {
                    "class":          'details-control2',
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": ''
                },
                { "data": "web_id" },
                { "data": "code" },
                { "data": "cname" },
                { "data": "customer" },
                { "data": "store" },
                { "data": "update_time" },
                { "data": "created_time", "visible": false},
                { "data": "name_bill", "visible": false},
                { "data": "street_bill", "visible": false},
                { "data": "street1_bill", "visible": false},
                { "data": "city_bill", "visible": false},
                { "data": "country_bill", "visible": false},
                { "data": "zip_bill", "visible": false},
                { "data": "name_ship1", "visible": false},
                { "data": "street_ship1", "visible": false},
                { "data": "street1_ship1", "visible": false},
                { "data": "city_ship1", "visible": false},
                { "data": "country_ship1", "visible": false},
                { "data": "zip_ship1", "visible": false},
                { "data": "name_ship2", "visible": false},
                { "data": "street_ship2", "visible": false},
                { "data": "street1_ship2", "visible": false},
                { "data": "city_ship2", "visible": false},
                { "data": "country_ship2", "visible": false},
                { "data": "zip_ship2", "visible": false},
                { "data": "name_ship3", "visible": false},
                { "data": "street_ship3", "visible": false},
                { "data": "street1_ship3", "visible": false},
                { "data": "city_ship3", "visible": false},
                { "data": "country_ship3", "visible": false},
                { "data": "zip_ship3", "visible": false},
                { "data": "name_ship4", "visible": false},
                { "data": "street_ship4", "visible": false},
                { "data": "street1_ship4", "visible": false},
                { "data": "city_ship4", "visible": false},
                { "data": "country_ship4", "visible": false},
                { "data": "zip_ship4", "visible": false},
                { "data": "name_ship5", "visible": false},
                { "data": "street_ship5", "visible": false},
                { "data": "street1_ship5", "visible": false},
                { "data": "city_ship5", "visible": false},
                { "data": "country_ship5", "visible": false},
                { "data": "zip_ship5", "visible": false},
                { "data": "user1", "visible": false},
                { "data": "user2", "visible": false},
                { "data": "user3", "visible": false},
                { "data": "user4", "visible": false},
                { "data": "user5", "visible": false},
                { "data": "user6", "visible": false},
                { "data": "user7", "visible": false},
                { "data": "user8", "visible": false},
                { "data": "user9", "visible": false},
                { "data": "user10", "visible": false},
                { "data": "user11", "visible": false},
                { "data": "user12", "visible": false},
                { "data": "user13", "visible": false},
                { "data": "user14", "visible": false},
                { "data": "user15", "visible": false},
                { "data": "user16", "visible": false},
                { "data": "user17", "visible": false},
                { "data": "user18", "visible": false},
                { "data": "user19", "visible": false},
                { "data": "user20", "visible": false}
            ],
            "order": [[2, 'asc']],
            "sPaginationType": "bootstrap",
            "pagingType": "full_numbers",
            "sDom": "<'row'<'col-xs-6 col-left'l><'col-xs-6 col-right'<'export-data'T>f>r>t<'row'<'col-xs-6 col-left'i><'col-xs-6 col-right'p>>",
            "oTableTools": {

                "sSwfPath": "{{ URL::asset('js/datatables/copy_csv_xls_pdf.swf') }}",
                "aButtons": [
                    "print",
                    {
                        "sExtends": "pdf",
                        "sFileName": "contracts.pdf",
                        "mColumns": [ 2,3,4,5,6,7 ]
                    },
                    {
                        "sExtends": "csv",
                        "sFileName": "contracts.csv",
                        "mColumns": [ 2,3,4,5,6,7,8,9,10,
                            11,12,13,14,15,16,17,18,19,20,
                            21,22,23,24,25,26,27,28,29,30,
                            31,32,33,34,35,36,37,38,39,40,
                            41,42,43,44,45,46,47,48,49,50,
                            51,52,53,54,55,56,57,58,59,60,
                            61,62,63,64]
                    },
                    {
                        "sExtends": "xls",
                        "sFileName": "contracts.xls",
                        "mColumns": [ 2,3,4,5,6,7,8,9,10,
                            11,12,13,14,15,16,17,18,19,20,
                            21,22,23,24,25,26,27,28,29,30,
                            31,32,33,34,35,36,37,38,39,40,
                            41,42,43,44,45,46,47,48,49,50,
                            51,52,53,54,55,56,57,58,59,60,
                            61,62,63,64]
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

        // Add event listener for opening and closing details
        $('#datatable tbody').on('click', 'td.details-control2', function () {
            console.log('clicked');
            var tr = $(this).closest('tr');
            var row = table.row( tr );

            if ( row.child.isShown() ) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown2');
            }
            else {
                // Open this row
                row.child( format2(row.data()) ).show();
                tr.addClass('shown2');
            }
        } );


    });
    </script>

@stop

@section('content')

<h2>{{ isset($heading) ? $heading : 'Contracts' }}</h2>

<table id="datatable" class="table table-bordered datatable">
    <thead>
    <tr>
        <th>Users (Show/Hide)</th>
        <th>Addresses (Show/Hide)</th>
        <th>ID</th>
        <th>Code</th>
        <th>Name</th>
        <th>Customer</th>
        <th>Store</th>
        <th>Last Updated</th>
        <th>Created At</th>
        <th>Bill To Name</th>
        <th>Bill To - Street L1</th>
        <th>Bill To - Street L2</th>
        <th>Bill To - City</th>
        <th>Bill To - Country</th>
        <th>Bill To - Zip</th>
        <th>Ship To 1 - Name</th>
        <th>Ship To 1 - Street L1</th>
        <th>Ship To 1 - Street L2</th>
        <th>Ship To 1 - City</th>
        <th>Ship To 1 - Country</th>
        <th>Ship To 1 - Zip</th>
        <th>Ship To 2 - Name</th>
        <th>Ship To 2 - Street L1</th>
        <th>Ship To 2 - Street L2</th>
        <th>Ship To 2 - City</th>
        <th>Ship To 2 - Country</th>
        <th>Ship To 2 - Zip</th>
        <th>Ship To 3 - Name</th>
        <th>Ship To 3 - Street L1</th>
        <th>Ship To 3 - Street L2</th>
        <th>Ship To 3 - City</th>
        <th>Ship To 3 - Country</th>
        <th>Ship To 3 - Zip</th>
        <th>Ship To 4 - Name</th>
        <th>Ship To 4 - Street L1</th>
        <th>Ship To 4 - Street L2</th>
        <th>Ship To 4 - City</th>
        <th>Ship To 4 - Country</th>
        <th>Ship To 4 - Zip</th>
        <th>Ship To 5 - Name</th>
        <th>Ship To 5 - Street L1</th>
        <th>Ship To 5 - Street L2</th>
        <th>Ship To 5 - City</th>
        <th>Ship To 5 - Country</th>
        <th>Ship To 5 - Zip</th>
        <th>User 1</th>
        <th>User 2</th>
        <th>User 3</th>
        <th>User 4</th>
        <th>User 5</th>
        <th>User 6</th>
        <th>User 7</th>
        <th>User 8</th>
        <th>User 9</th>
        <th>User 10</th>
        <th>User 11</th>
        <th>User 12</th>
        <th>User 13</th>
        <th>User 14</th>
        <th>User 15</th>
        <th>User 16</th>
        <th>User 17</th>
        <th>User 18</th>
        <th>User 19</th>
        <th>User 20</th>
    </tr>
    </thead>

</table>


@include('portal.partials._datatables')


@stop