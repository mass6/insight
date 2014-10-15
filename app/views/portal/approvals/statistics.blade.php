@extends($layout)

@section('links')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('js/datatables/css/jquery.dataTables.css') }}">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/plug-ins/28e7751dbec/integration/bootstrap/3/dataTables.bootstrap.css">


    <script class="init" type="text/javascript">

        $(document).ready(function() {

            var table = $('#datatable').DataTable({
                "sDom": "<'row'<'col-xs-6 col-left'l><'col-xs-6 col-right'<'export-data'T>f>r>t<'row'<'col-xs-6 col-left'i><'col-xs-6 col-right'p>>",
                "oTableTools": {
                    "sSwfPath": "{{ URL::asset('js/datatables/copy_csv_xls_pdf.swf') }}",
                    "aButtons": [
                        "print",
                        {
                            "sExtends": "csv",
                            "sFileName": "approval-history.csv",
                            "mColumns": 'all'
                        },
                        {
                            "sExtends": "xls",
                            "sFileName": "approval-history.xls",
                            "mColumns": 'all'
                        }
                    ]
                }


            });
        });
    </script>

@stop

@section('content')

<h2>Approval Statistics</h2>

<table id="datatable" class="table table-bordered datatable">
    <thead>
    <tr>
        @foreach ($approvalStatistics['header'] as $header)
            <th>{{ $header }}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
        @foreach ($approvalStatistics['report'] as $row)
            <tr>
                @foreach ($row as $column)
                    <td>{{ $column }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>

@include('portal.partials._datatables')

@stop