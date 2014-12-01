@extends($layout)

@section('content')


<h1>Export Request Data</h1>
    <p class="text text-info">Export request data into Excel or CSV format.</p>
    <br/>
    <br/>

<div class="row" style="min-height: 200px;">
    <div class="col-md-12">
        <h3>Select the filter and file format you wish to download.</h3>
        <br/>

        <div class="btn-group">
            <button type="button" class="btn btn-danger">Completed Requests</button>
            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                <i class="entypo-down"></i>
            </button>

            <ul class="dropdown-menu dropdown-danger" role="menu">
                <li><a href="{{ url('catalogue/product-definitions/download', ['filter' => 'completed', 'format' => 'xlsx']) }}"><i class="entypo-right"></i>Excel Format (xlsx)</a>
                </li>
                <li><a href="{{ url('catalogue/product-definitions/download', ['filter' => 'completed', 'format' => 'xls']) }}"><i class="entypo-right"></i>Excel Format (xls)</a>
                </li>
                <li><a href="{{ url('catalogue/product-definitions/download', ['filter' => 'completed', 'format' => 'csv']) }}"><i class="entypo-right"></i>CSV Format</a>
                </li>
            </ul>
        </div>

        <div class="btn-group">
            <button type="button" class="btn btn-danger">All Requests</button>
            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                <i class="entypo-down"></i>
            </button>

            <ul class="dropdown-menu dropdown-danger" role="menu">
                <li><a href="{{ url('catalogue/product-definitions/download', ['filter' => 'all', 'format' => 'xlsx']) }}"><i class="entypo-right"></i>Excel Format (xlsx)</a>
                </li>
                <li><a href="{{ url('catalogue/product-definitions/download', ['filter' => 'all', 'format' => 'xls']) }}"><i class="entypo-right"></i>Excel Format (xls)</a>
                </li>
                <li><a href="{{ url('catalogue/product-definitions/download', ['filter' => 'all', 'format' => 'csv']) }}"><i class="entypo-right"></i>CSV Format</a>
                </li>
            </ul>
        </div>

    </div>


</div>

@stop