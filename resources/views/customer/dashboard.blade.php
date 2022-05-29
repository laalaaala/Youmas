@extends('layouts.customerDashboard')

@section('content')
<div id="app" class="h-full">
    <customer-profile :user="{{json_encode($user)}}" />
</div>

@endsection