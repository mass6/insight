<div class="sidebar-menu">


<header class="logo-env">

    @if(isset($layoutPath))
        @include($layoutPath . '.partials._logo')
    @else
        @include('layouts.partials._logo')
      @endif

    <!-- logo collapse icon -->

    <div class="sidebar-collapse">
        <a href="#" class="sidebar-collapse-icon with-animation"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
            <i class="entypo-menu"></i>
        </a>
    </div>



    <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
    <div class="sidebar-mobile-menu visible-xs">
        <a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
            <i class="entypo-menu"></i>
        </a>
    </div>

</header>

@if (Sentry::check())
    <ul id="main-menu" class="auto-inherit-active-class">
        <!-- add class "multiple-expanded" to allow multiple submenus to open -->
        <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
        <!-- Search Bar -->
        <!--<li id="search">-->
        <!--    <form method="get" action="">-->
        <!--        <input type="text" name="q" class="search-input" placeholder="Search something..."/>-->
        <!--        <button type="submit">-->
        <!--            <i class="entypo-search"></i>-->
        <!--        </button>-->
        <!--    </form>-->
        <!--</li>-->
        @if ($currentUser->hasAccess('dashboards'))
            <li id="nav-dashboards" class="{{ isActive('dashboard', 1) }}">
                <a href="{{ route('dashboards.home') }}">
                    <i class="entypo-gauge"></i>
                    <span>Dashboard</span>
                </a>
                <!--    <ul>-->
                <!--        <li class="{{ isActive('dashboard', 1) }}">-->
                <!--            <a href="">-->
                <!--                <span>Dashboard</span>-->
                <!--            </a>-->
                <!--        </li>-->
                <!--    </ul>-->
            </li>
        @endif
        @if ($currentUser->hasAccess('portal.*'))


            @if ($currentUser->hasAccess('portal.orders'))
                <li class="auto-inherit-active-class {{ isActive('orders', 2, true) }}">
                    <a href="">
                        <i class="entypo-ticket"></i>
                        <span>Orders</span>
                    </a>
                    <ul>
                        <li id="search">
                            {{ Form::open(['route'=>'portal.orders.search', 'method'=>'GET']) }}
                            <input type="text" name="s" class="search-input" placeholder="Search Weborders..."/>
                            <button type="submit">
                                <i class="entypo-search"></i>
                            </button>
                            {{ Form::close() }}
                        </li>
                        <li class="{{ isActive('search', 3) }}">
                            <a href="{{ route('portal.orders.search') }}">
                                <span>Search</span>
                            </a>
                        </li>
                        <li class="{{ isActive('search', 3) }}">
                            <a href="{{ route('portal.orders.pending-approval') }}">
                                <span>Pending Approval</span>
                            </a>
                        </li>
                        <li class="{{ isActive('today', 3) }}">
                            <a href="{{ route('portal.orders.period', 'today') }}">
                                <span>Today</span>
                            </a>
                        </li>
                        <li class="{{ isActive('yesterday', 3) }}">
                            <a href="{{ route('portal.orders.period', 'yesterday') }}">
                                <span>Yesterday</span>
                            </a>
                        </li>
                        <li class="{{ isActive('this-month', 3) }}">
                            <a href="{{ route('portal.orders.period', 'this-month') }}">
                                <span>This Month</span>
                            </a>
                        </li>
                        <li class="{{ isActive('last-month', 3) }}">
                            <a href="{{ route('portal.orders.period', 'last-month') }}">
                                <span>Last Month</span>
                            </a>
                        </li>
                        <li class="{{ isActive('ytd', 3) }}">
                            <a href="{{ route('portal.orders.period', 'ytd') }}">
                                <span>Year to Date</span>
                            </a>
                        </li>
                        <li class="{{ isActive('third-party-this-month', 3) }}">
                            <a href="{{ route('portal.orders.period', 'third-party-this-month') }}">
                                <span>Third Party This Month</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
            @if ($currentUser->hasAccess('portal.contracts'))
                <li class="{{ isActive('contracts', 2) }}">
                    <a href="{{ route('portal.contracts') }}">
                        <i class="entypo-docs"></i>
                        <span>Contracts</span>
                    </a>
                </li>
            @endif
            @if ($currentUser->hasAccess('portal.users'))
                <li class="{{ isActive('users', 2) }}">
                    <a href="{{ route('portal.users') }}">
                        <i class="entypo-cc-by"></i>
                        <span>Portal Users</span>
                    </a>
                </li>
            @endif
            @if ($currentUser->hasAccess('portal.products'))
                <li class="{{ isActive('products', 2) }}">
                    <a href="{{ route('portal.products') }}">
                        <i class="entypo-basket"></i>
                        <span>Products</span>
                    </a>
                </li>
            @endif
            @if ($currentUser->hasAccess('portal.approvals'))
            <li class="auto-inherit-active-class {{ isActive('approvals', 2) }}">
                <a href="{{ route('portal.approval-statistics') }}">
                    <i class="entypo-check"></i>
                    <span>Approval Statistics</span>
                </a>
            </li>
            @endif
            @if ($currentUser->hasAccess('portal.budgets'))
                <li class="{{ isActive('budgets', 2) }}">
                    <a href="">
                        <i class="entypo-chart-line"></i>
                        <span>Budgets</span>
                    </a>
                </li>
            @endif
            @if ($currentUser->hasAccess('portal.doa'))
                <li class="{{ isActive('doa', 2) }}">
                    <a href="{{ route('portal.doa') }}">
                        <i class="entypo-flag"></i>
                        <span>DOA</span>
                    </a>
                </li>
            @endif
        @endif
        @if ($currentUser->hasAccess('cataloguing.*'))
            <li class="auto-inherit-active-class {{ isActive('catalogue', 1, true) }}">
                <a href="#">
                    <i class="entypo-archive"></i>
                    <span>Product Cataloguing</span>
                </a>
                <ul>
                    <li class="auto-inherit-active-class {{ isActive('myrequests', 3) }}">
                        <a href="{{ route('catalogue.product-definitions.queue') }}">
                            <i class="entypo-inbox"></i>
                            <span>My Requests Queue</span>
                        </a>
                    </li>
                @if($currentUser->hasAccess('cataloguing.products.customer'))
                    <li class="auto-inherit-active-class {{ isActive('', 3) }}">
                        <a href="{{ route('catalogue.product-definitions.index') }}">
                            <i class="entypo-doc-text"></i>
                            <span>All Cataloguing Requests</span>
                        </a>
                    </li>
                    <li class="auto-inherit-active-class {{ isActive('completed', 3) }}">
                        <a href="{{ route('catalogue.product-definitions.completed') }}">
                            <i class="entypo-check"></i>
                            <span>Completed Requests</span>
                        </a>
                    </li>
                @endif
                @if($currentUser->hasAccess('cataloguing.products.add'))
                    <li class="auto-inherit-active-class {{ isActive('create', 3) }}">
                        <a href="{{ route('catalogue.product-definitions.create') }}">
                            <i class="entypo-plus-squared"></i>
                            <span>New Request</span>
                        </a>
                    </li>
                @endif
                </ul>
            </li>
        @endif
<!--        @if ($currentUser->hasAccess('sourcing.*'))-->
<!--            <li class="auto-inherit-active-class">-->
<!--                <a href="">-->
<!--                    <i class="entypo-network"></i>-->
<!--                    <span>Products Sourcing</span>-->
<!--                </a>-->
<!--                <ul>-->
<!--                    <li class="{{ isActive('item-requests', 1) }}">-->
<!--                        <a href="">-->
<!--                            <i class="entypo-export"></i>-->
<!--                            <span>Product Requests</span>-->
<!--                        </a>-->
<!--                    </li>-->
<!--                    <li class="{{ isActive('quotations', 1) }}">-->
<!--                        <a href="">-->
<!--                            <i class="entypo-attach"></i>-->
<!--                            <span>Quotations</span>-->
<!--                        </a>-->
<!--                    </li>-->
<!--                            <li class="{{ isActive('categories', 1) }}">-->
<!--                                <a href="">-->
<!--                                    <span>Product Categories</span>-->
<!--                                </a>-->
<!--                            </li>-->
<!--                </ul>-->
<!--            </li>-->
<!--        @endif-->
<!--        @if ($currentUser->hasAccess('partners.*'))-->
<!--            <li class="auto-inherit-active-class {{ isActive('customers', 1, true) }}{{ isActive('suppliers', 1, true) }}">-->
<!--                <a href="">-->
<!--                    <i class="entypo-users"></i>-->
<!--                    <span>Partners</span>-->
<!--                </a>-->
<!--                <ul>-->
<!--                    <li class="{{ isActive('customers', 1) }}">-->
<!--                        <a href="">-->
<!--                            <span>Customers</span>-->
<!--                        </a>-->
<!--                    </li>-->
<!--                    <li class="{{ isActive('suppliers', 1) }}">-->
<!--                        <a href="">-->
<!--                            <span>Suppliers</span>-->
<!--                        </a>-->
<!--                    </li>-->
<!--                </ul>-->
<!--            </li>-->
<!--        @endif-->
        @if ($currentUser->hasAccess('admin'))
            <li class="auto-inherit-active-class {{ isActive('companies', 2, true) }}{{ isActive('users', 2, true) }}{{ isActive('permissions', 2, true) }}{{ isActive('groups', 2, true) }}">
            <a href="{{ route('admin.index') }}">
                <i class="entypo-tools"></i>
                <span>Admin</span>
            </a>
            <ul>
                @if ($currentUser->hasAccess('companies.*'))
                    <li class="{{ isActive('companies', 2) }}">
                        <a href="{{ route('admin.companies.index') }}">
                            <i class="entypo-flow-tree"></i>
                            <span>Companies</span>
                        </a>
                    </li>
                @endif
                @if ($currentUser->hasAccess('users.*'))
                    <li class="{{ isActive('users', 2) }}">
                        <a href="{{ route('admin.users.index') }}">
                            <i class="entypo-users"></i>
                            <span>Users</span>
                        </a>
                    </li>
                @endif
                @if ($currentUser->hasAccess('permissions.*'))
                    <li class="{{ isActive('permissions', 2) }}">
                        <a href="{{ route('admin.permissions.index') }}">
                            <i class="entypo-thumbs-up"></i>
                            <span>Permissions</span>
                        </a>
                    </li>
                @endif
                @if ($currentUser->hasAccess('groups.*'))
                    <li class="{{ isActive('groups', 2) }}">
                        <a href="{{ route('admin.groups.index') }}">
                            <i class="entypo-network"></i>
                            <span>Groups</span>
                        </a>
                    </li>
                @endif
                @if ($currentUser->hasAccess('logs.*'))
                <li class="{{ isActive('logviewer', 2) }}">
                    <a href="{{ url('admin/logviewer') }}">
                        <i class="entypo-archive"></i>
                        <span>Logs</span>
                    </a>
                </li>
                @endif
                @if ($currentUser->hasAccess('settings.*'))
                <li class="{{ isActive('settings', 2) }}">
                    <a href="{{ url('admin/settings') }}">
                        <i class="entypo-cog"></i>
                        <span>Settings</span>
                    </a>
                </li>
                @endif
            </ul>
        </li>
        @endif

    </ul>

@endif



</div>