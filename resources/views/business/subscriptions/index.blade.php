@extends('layouts.dashboard')

@section('content')
<!--Title-->

<div id="app" class="">
    <!-- Subscription Payment -->
    @if(!$subscription || $subscription->status == 'inactive')
    <business-subscription :user="{{json_encode($user)}}"></business-subscription>
    <!-- Subscription Detail -->
    @else
    <business-subscription-detail :subscription="{{json_encode($subscription)}}"></business-subscription-detail>
    @endif
</div>

@endsection