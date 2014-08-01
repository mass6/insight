<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Insight</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ URL::asset('css/main.css') }}"/>

    <script src="{{ URL::asset('js/jquery-1.11.0.min.js') }}"></script>
    @yield('links')

</head>
<body>
@include('layouts.partials.nav-default')

<div class="container">
    @include('flash::message')

    @yield('content')
</div>

<script src="//code.jquery.com/jquery.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

@include('layouts.partials._footerlinks')

</body>
</html>