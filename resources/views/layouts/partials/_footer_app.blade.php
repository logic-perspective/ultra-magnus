<footer class="footer">
    <div class="container-fluid">
        <nav class="float-left text-warning">
            <ul>
                <li>
                    <a href="https://www.pointcrime.com/" target="_blank">@lang('Website')</a>
                </li>
            </ul>
        </nav>

        <div class="copyright float-right">
            &copy; {{ \Carbon\Carbon::now()->year }}
            <a class="text-warning" href="http://www.pointcrime.com" target="_blank">{{ __('Point Crime') }}</a>
        </div>
    </div>
</footer>
