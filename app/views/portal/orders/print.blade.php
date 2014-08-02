@extends('layouts.print')

@section('links')

<style>

    body {font-size: 1em;}
    .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {padding:0;}
    .table > tbody > tr > td { border-top: none; border-bottom: 1px solid #ebebeb;}
    .table {margin-bottom: 0;}
    .table > tbody > tr > td, .table > thead > tr > th {padding-left: 5px;padding-right: 5px;}
    blockquote {
        padding: 0px 17px;
        margin: 0 0 17px;
        border-left: 5px solid #eeeeee;
    }
    #items-ordered th, #items-ordered td {text-align: right;}
    #items-ordered td.left, #items-ordered th.left {text-align: left;}
    .right {text-align: right;}
    #items-ordered td.center, #items-ordered th.center {text-align: center;}

</style>

@stop

<?php
$fields = explode('<br/>',$order['ship_to']);
if(count($fields) > 4 &&
    ($fields[count($fields)-1] == '01' ||
        $fields[count($fields)-1] == '02' ||
        $fields[count($fields)-1] == '10' ||
        $fields[count($fields)-1] == '11')){
    array_pop($fields);
    $order['ship_to'] = implode('<br/>',$fields);
};?>


@section('content')

<h2>Order Details - <small>#{{ $order['increment_id'] }} | {{ $order['created_at'] }}</small></h2>
<br />


    <div class="row">

        <div class="col-md-12">

            <div class="panel panel-dark" data-collapsed="0">

                <!-- panel head -->
                <div class="panel-heading">
                    <div class="panel-title">Order #{{ $order['increment_id'] }}</div>

                    <div class="panel-options">
                        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                        <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
                    </div>
                </div>

                <!-- panel body -->
                <div class="panel-body">

                    <div class="col-md-6">
                        <blockquote class="">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td>Order Date:</td>
                                    <td>{{ $order['created_at'] }}</td>
                                </tr>
                                <tr>
                                    <td>Status:</td>
                                    <td>{{ $order['status'] }}</td>
                                </tr>
                                <tr>
                                    <td>Contract:</td>
                                    <td>{{ $order['code'] . ' - ' . $order['contract'] }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </blockquote>

                    </div>

                    <div class="col-md-6">
                        <blockquote class="">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td>Ordered by:</td>
                                    <td>{{ $order['ordered_by'] }}</td>
                                </tr>
                                <tr>
                                    <td>Email:</td>
                                    <td>{{ $order['customer_email'] }}</td>
                                </tr>
                                <tr>
                                    <td>Approved by:</td>
                                    <td>{{ $order['approved_by'] }}</td>
                                </tr>
                                <tr>
                                    <td>Approved at:</td>
                                    <td>{{ $order['approved_at'] }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-6">

            <div class="panel panel-dark" data-collapsed="0">

                <!-- panel head -->
                <div class="panel-heading">
                    <div class="panel-title">Billing Information</div>

                    <div class="panel-options">
                        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                        <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
                    </div>
                </div>

                <!-- panel body -->
                <div class="panel-body">

                    <table class="">
                        <tbody>
                        <tr>
                            <td>{{ $order['bill_to'] }}</td>
                        </tr>
                        </tbody>
                    </table>

                </div>

            </div>

        </div>

        <div class="col-md-6">

            <div class="panel panel-dark" data-collapsed="0">

                <!-- panel head -->
                <div class="panel-heading">
                    <div class="panel-title">Delivery Information</div>

                    <div class="panel-options">
                        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                        <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
                    </div>
                </div>

                <!-- panel body -->
                <div class="panel-body">

                    <table class="">
                        <tbody>
                        <tr>
                            <td>{{ $order['ship_to'] }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>

        </div>

    </div>

    <div class="row">

        <div class="col-md-12">

            <div class="panel panel-dark" data-collapsed="0">

                <!-- panel head -->
                <div class="panel-heading">
                    <div class="panel-title">Items Ordered</div>

                    <div class="panel-options">
                        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                        <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
                    </div>
                </div>

                <!-- panel body -->
                <div class="panel-body">
                    <table  id="items-ordered" class="table table-bordered table-hover">
                        <colgroup>
                            <col style="width:40%">
                            <col style="width:5%">
                            <col style="width:2%">
                            <col style="width:10%">
                            <col style="width:2%">
                            <col style="width:4%">
                        </colgroup>
                        <thead>
                        <tr>
                            <th class="left">Product</th>
                            <th class="left">Supplier</th>
                            <th>Price</th>
                            <th>UOM</th>
                            <th>Qty</th>
                            <th>Row Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($items as $item)
                        <tr>
                            <td class="left">SKU: {{ $item['sku'] }}<br/>{{ $item['name'] }}</td>
                            <td class="left">{{ $item['supplier'] }}</td>
                            <td class="right">{{ $item['price'] }}</td>
                            <td>{{ $item['uom'] }}</td>
                            <td>{{ $item['qty'] }}</td>
                            <td class="right">{{ $item['row_total'] }}</td>
                        </tr>
                        @endforeach
                        </tbody>

                    </table>

                    <h4 class="text-right">Grand Total {{ $order['grand_total'] }}</h4>

                </div>
            </div>
        </div>
    </div>


<script type="text/javascript">
    $(document).ready(function() {
        window.print();
        window.close();
    });

</script>


@stop