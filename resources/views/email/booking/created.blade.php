@extends('layouts.email')

@section('content')
    <div>
        <h3>Sehr geehrte/r {{ $customer_name }},</h3>
        Wir bedanken uns für deine Buchung und werden dich noch zweimal vor Terminbeginn per Email erinnern. Wir bitten dich
        rechtzeitig den Termin zu stornieren, falls es nicht möglich ist diesen wahrzunehmen.<br>
        {{ $service_name }}, {{ $booking_created_date }}<br>
        {{ $business_name }} in {{ $business_location['street'] }} {{ $business_location['street_number'] }} |
        {{ $business_location['zip_code'] }} | {{ $business_location['city'] }}<br>
        Telefon {{ $business_phone }} | Fax: | Email: {{ $business_email }}<br><br>

        IHRE BUCHUNGSDETAILS IM ÜBERBLICK<br><br>

        <!-- Buchungsnummer: 38672592 -->
        Buchungsdatum: {{ $booking_created_date }}<br>
        Gebucht über: www.Youmas.de<br>
        Buchungsmodul: {{ $service_name }}<br>
        {{-- Zeitraum: {{ $booking_start }} Uhr<br> --}}
        <!-- Bezahlt: Google Pay -->
        Summe: {{ $total_price }}€<br>
        {{-- Anrede: {{ $customer_salutation }}<br> --}}
        Vorname: {{ $customer_first_name }}<br>
        Nachname: {{ $customer_last_name }}<br>
        Mobiltelefon: +49 {{ $customer_mobile_phone }}<br>
        PLZ/Ort: {{ $customer_zip_code }} {{ $customer_city }}<br><br>

        Die nachfolgenden Bedingungen (Abkürzung BHP) werden, soweit gültig vereinbart, Inhalt der Reservierung zwischen
        Kunde und Dienstleister und sind damit Vertragsinhalt. Wir bitten sie darum, diese Bedingungen genau zu lesen und
        unsere AGB zu beachten.<br><br>

        Ihr Youmas-Team<br><br>

        Dies ist eine automatisch generierte E-Mail von einer System-Email-Adresse. Bitte antworte nicht auf diese Mail.
    </div>
@endsection
