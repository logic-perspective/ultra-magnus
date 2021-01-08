<meta charset="utf-8">
<title>@hasSection('metaTitle') @yield('metaTitle') @else {{ config('app.name', 'Point Crime') }} @endif</title>

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no">

<meta name="robots" content="none">
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="icon" type="image/png" href="{{ secure_asset('img/favicon.png') }}">
<link href="{{ mix('css/app.css') }}" rel="stylesheet">
