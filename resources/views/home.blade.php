@extends('layouts.main')

@section('title', __('Point Crime'))

@section('content')
    <div class="container-fluid">
        <router-view></router-view>
    </div>
@endsection
