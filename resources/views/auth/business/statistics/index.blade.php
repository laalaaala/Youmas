@extends('layouts.dashboard')

@section('content')

<!--Title-->
<div id="app">    
    <div class="font-sans">
        <a href="#" class="
        text-base
        font-bold
        no-underline
        md:text-sm
        text-primary-400
        hover:underline
        ">Statistics</a>
        <h1 class="pt-6 pb-2 font-sans text-xl text-gray-900 break-normal"></h1>
    </div>
    
    <business-statistics></business-statistics>
</div>
@endsection