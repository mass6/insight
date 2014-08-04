@extends($layout)

@section('links')
@parent
<link rel="shortcut icon" href="{{ URL::to('packages/kmd/logviewer/ico/favicon.png') }}">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ URL::to('packages/kmd/logviewer/ico/apple-touch-icon-144-precomposed.png') }}">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ URL::to('packages/kmd/logviewer/ico/apple-touch-icon-114-precomposed.png') }}">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ URL::to('packages/kmd/logviewer/ico/apple-touch-icon-72-precomposed.png') }}">
<link rel="apple-touch-icon-precomposed" href="{{ URL::to('packages/kmd/logviewer/ico/apple-touch-icon-57-precomposed.png') }}">
@stop

@section('content')

    <h1>Testing</h1>

@stop