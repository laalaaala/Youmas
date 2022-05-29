@extends('layouts.email')

@section('content')

<h3>Guten Tag {{ $customer_name }}, </h3>
Wir danken ihnen für ihre Buchung, jedoch müssen wir ihnen leider mitteilen, dass ihr Termin mit der Buchungsnummer {{$booking_number}} unsererseits storniert wurde, wir bitten um Verständnis.<br /><br />

<strong>IHRE BUCHUNGSDETAILS IM ÜBERBLICK</strong><br />
<strong>Buchungsnummer:</strong> {{$booking_number}} <br />
<strong>Buchungsdatum:</strong> {{$booking_start}}<br />
<strong>Gebucht über:</strong> www.Youmas.de<br />
<strong>Buchungsmodul:</strong> {{ $service_name }}<br />
<!-- <strong>Zeitraum:</strong>  Sa, 03.04.2021  16 Uhr  -->
<!-- <strong>Bezahlt:</strong>  Per Bar/Google Pay -->
<strong>Summe:</strong> {{$total_price}}€<br /><br />

Wir werden ihnen so bald wie möglich die Buchungssumme über {{$total_price}} erstatten. Dies dauert in der Regel 3-5 Werktage und wird dem Konto gutgeschrieben, welches die Transaktion ausgeführt hat.<br /><br />

Um genaue Informationen zu ihrer Bestellung und ihren Bestellstatus zu erhalten, klicken sie bitte auf den folgenden Link: <a href="https://youmas.de/dashboard/bookings" target="_blank"> Meine Buchungen</a><br /><br />

Vielen Dank für ihre Geduld ! Wir freuen uns, sie bald wieder als Kunde begrüßen zu dürfen!<br /><br />

Hierbei handelt es sich um eine automatisch generierte E-Mail einer System-Email. Bitte antworte nicht auf diese Mail.

@endsection