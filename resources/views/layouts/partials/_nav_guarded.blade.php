<nav class="navbar navbar-expand-lg navbar-absolute fixed-top text-white header-filter" filter-color="navy">
    <div class="container">
        <div class="navbar-wrapper">
            <a class="navbar-brand" href="{{ secure_url('/') }}"><img src="{{ secure_asset('img/logo.svg') }}" width="155"></a>
        </div>

        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation" data-target="#navigation-example">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
                @if (! Auth::check())
                <li class="nav-item">
                    <a href="{{ route('login') }}" class="nav-link">
                        <i class="material-icons">fingerprint</i> Login
                    </a>
                </li>

                <li class="nav-item">
                    <a href="https://www.sendmarc.co.za/contact-us/" class="nav-link">
                        <i class="material-icons">person_add</i> @lang('Sign Up')
                    </a>
                </li>
                @else
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link">
                        <i class="material-icons">dashboard</i> @lang('Dashboard')
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>