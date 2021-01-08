<tr>
<td class="header">
<table class="inner-header" align="center" width="570" cellpadding="0" cellspacing="0" role="heading">
<tr>
<td class="header-logo" align="center"><a href="{{ $url }}"><img src="{{ secure_asset('images/logo.png') }}" width="155" alt="{{ config('app.name', 'Sendmarc') }}"></a></td>
</tr>
@if ($title)
<tr>
<td class="header-title" align="center" valign="middle" style="text-align: center">{{ $title ?? '' }}</td>
</tr>
@endif
</table>
</td>
</tr>