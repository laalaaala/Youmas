@extends('layouts.customerDashboard')

@section('content')
<div class="p-5 pt-0 bg-white rounded-sm shadow-sm" id="app">
    <customer-booking-table :bookings="{{json_encode($bookings)}}"></customer-booking-table>
</div>
@endsection