@extends($layout)

@section('content')

<!-- Main component for a primary marketing message or call to action -->
<div class="jumbotron">
    <h1>Welcome to Insight!</h1>
    <p>{{ link_to_route('login_path', 'Log in', null, ['class' => 'btn btn-primary']) }} to get started</p>
    <p>{{ $currentUser }}</p>
    <p>Company: {{ Session::get('company', 'none') }}</p>
    <p>Layout: {{ $layout }}</p>
    <p>SuperUser: {{ $currentUser->isSuperUser() ? 'true' : 'false' }}</p>

</div>


@stop
