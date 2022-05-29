@extends('layouts.customerDashboard')

@section('content')
<div class="mt-5 bg-white rounded-sm shadow-sm md:p-5" id="app">
    <customer-favorites :favorites="{{json_encode($favs)}}"></customer-favorites>

</div>

@endsection