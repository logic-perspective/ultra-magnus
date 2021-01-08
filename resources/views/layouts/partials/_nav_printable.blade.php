<nav class="navbar navbar-expand-lg text-white header-filter" filter-color="navy">
    <div class="container">
        <a class="navbar-brand" href="{{ secure_url('/') }}"><img src="{{ secure_asset('img/favicon.svg') }}" width="200"></a>

        <div class="d-flex flex-column align-items-end">
            @hasSection('pageTitle')
            <h1>@yield('pageTitle')</h1>
            @endif

            @hasSection('pageSubTitle')
            <h3 class="mt-0 text-grey">@yield('pageSubTitle')</h3>
            @endif
        </div>
    </div>
</nav>