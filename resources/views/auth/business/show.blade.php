@extends('layouts.app')

@section('content')
<main>

    <div id="app">
        <business :business-service-categories="{{json_encode($business_service_categories)}}" :business="{{json_encode($business)}}"></business>
    </div>
</main>
@endsection