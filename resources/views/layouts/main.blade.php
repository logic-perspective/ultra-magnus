<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
@include('layouts.partials._head_common')
</head>

<body>
    <div id="app" class="wrapper">
        @include('layouts.partials._sidebar')

        <div class="main-panel">
            @include('layouts.partials._nav_app')

            <div class="content">
                @yield('content')
            </div>

            @include('layouts.partials._footer_app')
        </div>
    </div>

    @include('layouts.partials._scripts_common')
</body>
</html>
