<div class="row">

<!-- Profile Info and Notifications -->
<div class="col-md-6 col-sm-8 clearfix">

<ul class="user-info pull-left pull-none-xsm">

    @if(Sentry::check())
    <!-- Profile Info -->
    <li class="profile-info dropdown"><!-- add class "pull-right" if you want to place this from right -->

        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="{{ $currentUser->profile->avatar->url('thumb') }}" alt="" class="img-circle" width="44" />
            {{ $currentUser->name() }}
        </a>

        <ul class="dropdown-menu">

            <!-- Reverse Caret -->
            <li class="caret"></li>

            <!-- Profile sub-links -->
            <li>
                <a href="{{ route('profiles.show', $currentUser->id ) }}">
                    <i class="entypo-user"></i>
                    My Profile
                </a>
            </li>
        </ul>
    </li>
    @endif

</ul>

</div>


<!-- Raw Links -->
<div class="col-md-6 col-sm-4 clearfix hidden-xs">

    <ul class="list-inline links-list pull-right">
        <li>
            <a href="{{ route('logout_path') }}">
                Log Out <i class="entypo-logout right"></i>
            </a>
        </li>
    </ul>

</div>

</div>

<hr />