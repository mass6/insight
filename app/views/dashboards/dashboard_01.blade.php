@extends($layout)

@section('links')
<link rel="stylesheet" href="{{ URL::asset('css/font-icons/font-awesome/css/font-awesome.min.css') }}">
@stop

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="well">
            <h1>Executive Dashboard <small class="pull-right">{{ Carbon::now()->format('d/m/Y') }}</small></h1>
        </div>
    </div>
</div>

<div class="row">

    <div class="col-sm-3">
        <a href="{{ route('portal.approvals') }}">
            <div class="tile-stats tile-red">
                <div class="icon"><i class="entypo-loop"></i></div>
                <div id="pending-approval-count" class="num" data-start="0" data-end="0" data-postfix="" data-duration="1500" data-delay="0">0</div>
                <span class="lab">AED </span><div id="pending-approval-value" class="val" data-start="0" data-end="0" data-postfix="" data-duration="1500" data-delay="0">0</div>

                <h3>Pending Approval</h3>
                <p>waiting to be approved.</p>
            </div>
        </a>
    </div>

    <div class="col-sm-3">
        <a href="{{ route('portal.orders.period', 'today') }}">
            <div class="tile-stats tile-green">
                <div class="icon"><i class="entypo-basket"></i></div>
                <div id="orders-today-count" class="num" data-start="0" data-end="0" data-postfix="" data-duration="1500" data-delay="0">0</div>
                <span class="lab">AED </span><div id="orders-today-value" class="val" data-start="0" data-end="0" data-postfix="" data-duration="1500" data-delay="0">0</div>

                <h3>Orders Approved Today</h3>
                <p>approved so far today.</p>
            </div>
        </a>

    </div>

    <div class="col-sm-3">
        <a href="{{ route('portal.orders.period', 'this-month') }}">
            <div class="tile-stats tile-aqua">
                <div class="icon"><i class="entypo-chart-area"></i></div>
                <div id="monthly-order-count" class="num" data-start="0" data-end="23" data-postfix="" data-duration="1500" data-delay="1200">0</div>
                <span class="lab">AED </span><div id="monthly-order-value" class="val" data-start="0" data-end="23" data-postfix="" data-duration="1500" data-delay="1200">0</div>

                <h3>Current Month's Orders</h3>
                <p>total orders so far this month.</p>
            </div>
        </a>
    </div>

    <div class="col-sm-3">
        <a href="{{ route('portal.orders.period', 'third-party-this-month') }}">
            <div class="tile-stats tile-blue">
                <div class="icon"><i class="entypo-export"></i></div>
                <div id="third-party-order-count" class="num" data-start="0" data-end="52" data-postfix="" data-duration="1500" data-delay="1800">0</div>
                <span class="lab">AED </span><div id="third-party-order-value" class="val" data-start="0" data-end="52" data-postfix="" data-duration="1500" data-delay="1800">0</div>

                <h3>Third Party Orders</h3>
                <p>orders to third-party suppliers this month.</p>
            </div>
        </a>
    </div>
</div>

<br />

<div id="spend-analysis" class="page-header">
    <h3>Spend Analysis</h3>
</div>
<div class="row">
    <div class="col-sm-8">

        <div class="panel panel-primary" id="charts_env">

            <div class="panel-heading">
                <div class="panel-title">Daily Order Totals - Last 60 Days</div>

                <div class="panel-options">
                    <ul class="nav nav-tabs">
                        <!--                        <li class=""><a href="#area-chart" data-toggle="tab">By Cateory</a></li>-->
                        <li class="active"><a href="#line-chart" data-toggle="tab">By Order Date</a></li>
                        <!--                        <li class=""><a href="#pie-chart" data-toggle="tab">Pie Chart</a></li>-->
                    </ul>
                </div>
            </div>

            <div class="panel-body">

                <div class="tab-content">

                    <div class="tab-pane" id="area-chart">
                        <div id="area-chart-demo" class="morrischart" style="height: 300px"></div>
                    </div>

                    <div class="tab-pane active" id="line-chart">
                        <div id="line-chart-demo" class="morrischart" style="height: 300px"></div>
                    </div>

                    <!--                    <div class="tab-pane" id="pie-chart">-->
                    <!--                        <div id="donut-chart-demo" class="morrischart" style="height: 300px;"></div>-->
                    <!--                    </div>-->

                </div>

            </div>



        </div>

    </div>

    <div class="col-sm-4">

        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4>
                        Spend by Category
                        <br />
                        <small>current month to date</small>
                    </h4>
                </div>

                <div class="panel-options">
                    <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
                    <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                    <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
                    <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
                </div>
            </div>

            <div class="panel-body no-padding">
                <!--                <div id="rickshaw-chart-demo">-->
                <!--                    <div id="rickshaw-legend"></div>-->
                <!--                </div>-->

                <div id="categorychart" style="height: 250px"></div>
            </div>
        </div>

    </div>
</div>




<script type="text/javascript">
jQuery(document).ready(function($)
{
    // set page-in animation class
    //document.body.className += ' ' + 'page-left-in';
    // Dashboard Panels
    document.getElementById('orders-today-count').setAttribute('data-end', Insight.ordersTodayCount);
    document.getElementById('orders-today-value').setAttribute('data-end', Insight.ordersTodayValue);
    document.getElementById('pending-approval-count').setAttribute('data-end', Insight.pendingApprovalCount);
    document.getElementById('pending-approval-value').setAttribute('data-end', Insight.pendingApprovalValue);
    document.getElementById('monthly-order-count').setAttribute('data-end', Insight.monthlyOrderCount);
    document.getElementById('monthly-order-value').setAttribute('data-end', Insight.monthlyOrderValue);
    document.getElementById('third-party-order-count').setAttribute('data-end', Insight.thirdPartyOrderCount);
    document.getElementById('third-party-order-value').setAttribute('data-end', Insight.thirdPartyOrderValue);





    // Line Charts
    var line_chart_demo = $("#line-chart-demo");

    var day = Insight.dailyOrderTotals;
    if (day.length){
        var linedata = [];
        for (var i = 0; i < day.length; i++)
        {
            linedata.push({d: day[i].day, v:day[i].total, c:day[i].count });
        }
    }

    var line_chart = Morris.Line({
        element: 'line-chart-demo',
        data: linedata,
        xkey: 'd',
        ykeys: ['v', 'c'],
        xlabels: ['day'],
        labels: ['Total AED', '# of orders'],
        parseTime: false,
        redraw: true
    });

    line_chart_demo.parent().attr('style', '');


    // Donut Chart
//        var donut_chart_demo = $("#donut-chart-demo");
//
//        donut_chart_demo.parent().show();
//
//        var donut_chart = Morris.Donut({
//            element: 'donut-chart-demo',
//            data: [
//                {label: "Download Sales", value: getRandomInt(10,50)},
//                {label: "In-Store Sales", value: getRandomInt(10,50)},
//                {label: "Mail-Order Sales", value: getRandomInt(10,50)}
//            ],
//            colors: ['#707f9b', '#455064', '#242d3c']
//        });
//
//        donut_chart_demo.parent().attr('style', '');

    // Cateogory Donut Chart
    var cat = Insight.spendPerCategory;
    if (cat.length){
        var donutdata = [];
        for (var i = 0; i < cat.length; i++)
        {
            donutdata.push({label: cat[i].category, value: cat[i].total});
        }
    }


    Morris.Donut({
        element: 'categorychart',
        data: donutdata,
        colors: ['#f26c4f', '#00a651', '#00bff3', '#0072bc']
    });


    // Area Chart
    var area_chart_demo = $("#area-chart-demo");

    area_chart_demo.parent().show();

    var area_chart = Morris.Area({
        element: 'area-chart-demo',
        data: [
            { y: '2014-01', a: 550, b: 110 },
            { y: '2014-02', a: 495,  b: 135 },
            { y: '2014-03', a: 750,  b: 120 },
            { y: '2014-04', a: 635,  b: 120 },
            { y: '2014-05', a: 705,  b: 85 },
            { y: '2014-06', a: 790,  b: 105 }
        ],
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['Series A', 'Series B'],
        lineColors: ['#303641', '#576277']
    });

    area_chart_demo.parent().attr('style', '');

});


function getRandomInt(min, max)
{
    return Math.floor(Math.random() * (max - min + 1)) + min;
}
</script>

@stop



@section('bottomlinks')

<script src="{{ URL::asset('js/jquery.sparkline.min.js') }}"></script>
<script src="{{ URL::asset('js/raphael-min.js') }}"></script>
<script src="{{ URL::asset('js/morris.min.js') }}"></script>
@stop