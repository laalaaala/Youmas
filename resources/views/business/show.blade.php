@extends('layouts.app')

@section('content')
<main>
    <div id="app">
        @if (isset($is_favorite))
        <business-single-view :auth="{{json_encode(true)}}" :is_favorite="{{json_encode($is_favorite)}}" :business-service-categories="{{json_encode($business_service_categories)}}" :business="{{json_encode($business)}}"></business-single-view>
        @else
        <business-single-view  :auth="{{json_encode(false)}}"  :business-service-categories="{{json_encode($business_service_categories)}}" :business="{{json_encode($business)}}"></business-single-view>

        @endif
    </div>
</main>
@endsection