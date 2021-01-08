<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('layouts.partials._head_common')
</head>

<body>
@include('layouts.partials._nav_printable')

<div id="app">
    @yield('content')
</div>

@include('.layouts.partials._footer_printable')

<script src="//cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
<script src="{{ mix('js/guarded.js') }}"></script>
</body>
</html>