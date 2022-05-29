@extends('layouts.email')

@section('content')
    <div>
        <h3>Sehr geehrte/r {{ $customer_name }},</h3>
        Wir möchten uns noch einmal für ihre Buchung danken und wollten Sie an den folgenden Termin erinnern.<br>
        Hier finden Sie Ihre Buchungsdetails im Überblick:<br>

        {{ $service_name }}, {{ $booking_created_date }}<br>
        {{ $business_name }} in {{ $business_location['street'] }} {{ $business_location['street_number'] }} |
        {{ $business_location['zip_code'] }} | {{ $business_location['city'] }}<br>
        Telefon {{ $business_phone }} | Fax: | Email: {{ $business_email }}<br><br>

        IHRE BUCHUNGSDETAILS IM ÜBERBLICK<br><br>

        Buchungsnummer: {{ $booking_id }}<br>
        Buchungsdatum: {{ $booking_created_date }}<br>
        Gebucht über: www.Youmas.de<br>
        Buchungsmodul: {{ $service_name }}<br>
        Zeitraum: {{ $booking_start }} Uhr<br>
        <!-- Bezahlt: Google Pay -->
        Summe: {{ $total_price }}€<br>
        {{-- Anrede: {{ $customer_salutation }}<br> --}}
        Vorname: {{ $customer_first_name }}<br>
        Nachname: {{ $customer_last_name }}<br>
        Mobiltelefon: +49 {{ $customer_mobile_phone }}<br>
        PLZ/Ort: {{ $customer_zip_code }} {{ $customer_city }}<br><br>

        Die nachfolgenden Bedingungen werden, soweit wirksam vereinbart, Inhalt des im Buchungsfall zwischen dem Kunde und
        dem Dienstleister – nachstehend „BHB“ abgekürzt – zu Stande kommenden Kundennahmevertrags Bitte lesen Sie diese
        Bedingungen daher sorgfältig durch. Hier muss noch dran gearbeitet werden am besten auf AGB Hinweisen<br><br>

        Ihr Team von Youmas<br><br>

        Dies ist eine automatisch generierte E-Mail von einer System-E-Mail-Adresse. <br>Bitte antworte nicht auf diese
        E-Mail.
    </div>
@endsection
