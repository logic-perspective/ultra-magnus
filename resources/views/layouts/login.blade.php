<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
@include('layouts.partials._head_common')
</head>

<body class="off-canvas-sidebar">
    @include('layouts.partials._nav_auth')

    <div class="wrapper wrapper-full-page">
        <div class="page-header login-page header-filter" filter-color="navy">
            @yield('content')
            @include('.layouts.partials._footer_auth')
        </div>
    </div>

    @include('layouts.partials._scripts_common')
    @include('layouts.partials._scripts_auth')
</body>
</html>