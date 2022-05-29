@extends('layouts.app')

@section('content')
<div id="app" class="w-full">
    <customer-checkout :business="{{json_encode($business)}}" :business-user="{{json_encode($businessUser)}}" :customer="{{json_encode($customer)}}"></customer-checkout>
</div>

@endsection