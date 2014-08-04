@extends($layout)

@section('links')
    @parent
    <style>
        .features img {border: 1px solid #d6d6d6;}
    </style>
@stop

@section('content')

<!-- Main component for a primary marketing message or call to action -->
<div class="jumbotron">
    <div class="row">
        <div class="col-md-6">
            <h1>Welcome to 36S Insight</h1>
            <h3>Real-time Reporting & Analytics</h3>
        </div>
        <div class="col-md-6">
            <img src="{{ URL::asset('images/analytics.jpg') }}">
        </div>
    </div>
</div>

<div class="container features">
    <!-- Example row of columns -->
    <div class="row">
        <div class="col-md-4">
            <a href="{{ route('dashboards.home') }}">
                <img src="{{ URL::asset('images/dashboard.png') }}">
            </a>
            <h2>Dashboard</h2>
            <p>Track and view real-time transactional and spend data. View spend and order totals across all product categories. Drill-down into daily, monthly, and yearly order totals. </p>
            <p><a class="btn btn-default" href="{{ route('dashboards.home') }}" role="button">View Dashboard »</a></p>
        </div>
        <div class="col-md-4">
            <a href="{{ route('portal.orders.period', 'this-month') }}">
                <img src="{{ URL::asset('images/web-orders.png') }}">
            </a>
            <h2>Web Orders</h2>
            <p>Search and drill-down into individual web orders to view line items and product details. Then, print or export to PDF.</p>
            <p><a class="btn btn-default" href="{{ route('portal.orders.period', 'this-month') }}" role="button">View Orders »</a></p>
        </div>
        <div class="col-md-4">
            <a href="{{ route('portal.contracts') }}">
                <img src="{{ URL::asset('images/contracts.png') }}">
            </a>
            <h2>Products, Users & Contracts</h2>
            <p>View all products, contracts, and users that are configured on the portal. Search, filter; then export to a spreadsheet or PDF. </p>
            <p><a class="btn btn-default" href="{{ route('portal.contracts') }}" role="button">View Contracts »</a></p>
        </div>
    </div>

    <hr>

</div>
@stop
