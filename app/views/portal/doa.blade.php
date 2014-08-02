@extends($layout)
@section('content')

<h2>Delegation of Authority</h2>
<br/>

@if (isset($doa))
<div class="panel panel-primary">
    <div class="panel-heading">
        <div class="panel-title">DOA Business Rules</div>
    </div>
    <table class="table table-bordered table-responsive">
        <thead>
        <th>No</th>
        <th>Customer</th>
        <th>Name</th>
        <th>Rule Condition</th>
        <th>L1</th>
        <th>L2</th>
        <th>L3</th>
        <th>L4</th>
        <th>L5</th>
        </thead>
        @foreach ($doa as $rule)
        <tr>
            <td>{{ $rule['rule_id'] }}</td>
            <td>{{ $rule['customer'] }}</td>
            <td>{{ $rule['name'] }}</td>
            <td>{{ $rule['orderamount'] }}</td>
            <td>{{ $rule['l1'] }}</td>
            <td>{{ $rule['l2'] }}</td>
            <td>{{ $rule['l3'] }}</td>
            <td>{{ $rule['l4'] }}</td>
            <td>{{ $rule['l5'] }}</td>
        </tr>

        @endforeach
    </table>
</div>
@endif

@stop