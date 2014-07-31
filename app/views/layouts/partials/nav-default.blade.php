<nav class="navbar navbar-default navbar-fixed-top navbar-inverse" role="navigation">
    <div class="container">

        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Insight</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Link</a></li>
                <li><a href="#">Link</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Administration<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li>{{ link_to_route('admin.users.index', 'Users') }}</li>
                        <li>{{ link_to_route('admin.permissions.index', 'Permissions') }}</li>
                        <li>{{ link_to_route('admin.groups.index', 'Groups') }}</li>
                        <li>{{ link_to_route('logout_path', 'Logout') }}</li>
                    </ul>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @if ($currentUser)
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img class="nav-gravatar" src="{{-- $currentUser->present()->gravatar --}}" alt="{{-- $currentUser->username --}}">
                        {{ $currentUser->first_name}}<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li class="divider"></li>
                        <li>{{ link_to_route('logout_path', 'Logout') }}</li>
                    </ul>
                </li>
                @else
                <li>{{ link_to_route('login_path', 'Login') }}</li>
                @endif
            </ul>

        </div>

    </div>
</nav>