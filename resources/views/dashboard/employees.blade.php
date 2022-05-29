@extends('layouts.dashboard')

@section('content')
<!--Title-->
<div class="font-sans">
    <a href="#" class="text-base font-bold no-underline md:text-sm text-primary-400 hover:underline">Mitarbeiter</a>
    <h1 class="pt-6 pb-2 font-sans text-xl text-gray-900 break-normal"></h1>
</div>
<div class="mt-5 bg-white rounded-sm shadow-sm md:p-5" id="app">
    <business-employee-table :business="{{json_encode($business)}}"></business-employee-table>
</div>
@endsection