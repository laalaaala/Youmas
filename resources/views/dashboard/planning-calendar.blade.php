@extends('layouts.dashboard')

@section('content')
<!--Title-->
<div class="font-sans">
    <a href="#" class="text-base font-bold no-underline md:text-sm text-primary-400 hover:underline">Planungskalendar</a>
</div>
<div class="p-5 px-0 mt-5 bg-white rounded-sm shadow-sm md:px-5" id="app">
    <business-planning-calendar :employees="{{json_encode($employees)}}"></business-planning-calendar>
</div>
@endsection