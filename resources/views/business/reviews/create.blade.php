@extends('layouts.app')

@section('content')
<!--Title-->

<main class="max-w-lg md:w-1/2 mx-auto flex items-center" id="app">
    <div class="w-full max-w-lg">
        <customer-business-review :business="{{json_encode($business)}}"></customer-business-review>
    </div>
</main>

@endsection