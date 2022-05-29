@extends('layouts.dashboard')

@section('content')
<!--Title-->

<div id="app">
    <business-subscriptions :user="{{json_encode($user)}}"></business-subscriptions>
</div>



@endsection