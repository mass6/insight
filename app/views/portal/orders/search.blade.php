@extends($layout)

@section('links')
    @parent
    <style>
        .search-results-env .search-results > .search-result {
            padding-bottom: 0px;
            margin-bottom: 0px;
        }
    </style>

@stop

@section('content')

<h2>Search Web Orders</h2>

<section class="search-results-env">

    <div class="row">
        <div class="col-md-12">


            <!-- Search categories tabs -->
            <ul class="nav nav-tabs right-aligned">
                <li class="tab-title pull-left">
                    @if (isset($searchTerm) && isset($results))
                    <div class="search-string">{{ $results->getTotal() ?: 'No' }} results found for: <strong>&ldquo;{{ $searchTerm }}&rdquo;</strong></div>
                    <br />
                    @endif
                </li>

                <!--    <li class="active">-->
                <!--        <a href="#orders">-->
                <!--            Orders-->
                <!--           <span class="disabled-text">(31)</span>-->
                <!--        </a>-->
                <!--    </li>-->
                <!--    <li>-->
                <!--        <a href="#members">Users</a>-->
                <!--    </li>-->
                <!--    <li>-->
                <!--        <a href="#messages">Messages</a>-->
                <!--    </li>-->
            </ul>

            <!-- Search search form -->
            {{ Form::open(['route'=>'portal.orders.search', 'method'=>'GET', 'class'=>'search-bar', 'enctype'=>'application/x-www-form-urlencoded']) }}
            <!--<form method="get" class="search-bar" action="" enctype="application/x-www-form-urlencoded">-->

            <div class="input-group">
                <input type="text" class="form-control input-lg" name="s" placeholder="Search by weborder number, location, contract, user, or order status...">

                <div class="input-group-btn">
                    <button type="submit" class="btn btn-lg btn-primary btn-icon">
                        Search
                        <i class="entypo-search"></i>
                    </button>
                </div>
            </div>

            {{ Form::close() }}
        @if (isset($results))
            @if(count($results))
            <div class="alert alert-warning clearfix" data-dismiss="alert">
                Results are listed left to right, newest on top.
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            </div>
            <!--   <h4 class="alert alert-warning"><em>Results are listed by my recent order date (left to right).<em></h4>-->
            <!-- Search search form -->
            <div class="search-results-panes">

                <div class="search-results-pane active" id="orders">

                    <ul class="search-results">
                        <?php $count = 0; ?>
                        @foreach ($results as $result)
                        <div class="col-md-3">
                            <li class="search-result">
                                <div class="sr-inner well">
                                    <h3>
                                        <a href="{{ route('portal.orders.details', $result['entity_id']) }}">{{ $result['web_order'] }}</a>
                                        <span class="badge {{ $result['badge'] }} pull-right">{{ $result['status'] }}</span>
                                    </h3>
                                    <h5 class="text-muted">{{ $result['contract'] }}</h5>
                                    <span class="text text-warning"><strong>AED {{ $result['grand_total'] }}</strong></span>
                                    <span class="text text-warning pull-right">{{ $result['created_at'] }}</span>
                                    <!--                <a href="{{ route('portal.orders.details', $result['web_order']) }}" class="link">view</a>-->
                                </div>
                            </li>
                        </div>
                        @endforeach
                    </ul>

                </div>

            </div>
            @endif
        @endif
        </div>

    </div>
    @if (isset($results))
        <div class="row">
            <!-- Pager for search results -->
            <ul class="pager">
                {{ $results->links() }}
            </ul>
        </div>
    </div>
    @endif
</section>
@stop