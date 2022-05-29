@extends('layouts.email')

@section('content')
<div>
    <h3>Guten Tag {{ $business_name }}</h3>: <br />
    die folgende Buchung wurde mit der Buchungsnummer {{$booking_number}} am {{ $cancelled_time }} vor Ablauf der festgelegten Frist erfolgreich storniert.<br><br>

    <strong>Buchungsdetails im Überblick </strong><br>
    <strong>Buchungsnummer:</strong> {{$booking_number}} <br>
    <strong>Buchungsdatum:</strong> {{$booking_start}} <br>
    <strong>Gebucht über:</strong> www.Youmas.de <br>
    <strong>Buchungsmodul:</strong> {{ $service_name }} <br>
    <!-- <strong>Zeitraum:</strong> {{ $cancelled_time }} <br> -->
    <!-- Bezahlt per: Per Bar/Google Pay -->
    <strong>Summe:</strong> {{ $total_price }}€ <br>
    <br><br>
    Hierbei handelt es sich um eine automatisch generierte E-Mail einer System-Email. Bitte antworte nicht auf diese Mail.
</div>
@endsection