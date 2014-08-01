@extends($layout)

@section('content')

<!-- Main component for a primary marketing message or call to action -->
<div class="jumbotron">
    <h1>Welcome to Insight!</h1>
    <p>{{ link_to_route('login_path', 'Log in', null, ['class' => 'btn btn-primary']) }} to get started</p>
    @if (Sentry::check())
        <p>{{ $currentUser }}</p>
        <p>Company: {{ $currentUser->company }}</p>
        <p>Layout: {{ $layout }}</p>
        <p>SuperUser: {{ $currentUser->isSuperUser() ? 'true' : 'false' }}</p>
    @endif

</div>


@stop
