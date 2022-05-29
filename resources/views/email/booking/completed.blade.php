@extends('layouts.email')

@section('content')
    <div>
        <h3>Sehr geehrte/r {{ $customer_name }},</h3>
        <p>wir haben uns gefreut Ihnen den besten Service zu liefern und hoffen Sie waren zufrieden mit der Leistung ihrer
            Buchung. Sie können gerne eine Bewertung abgeben indem Sie einfach <a href="{{ $link }}">Hier</a>
            (Hyperlink for review) klicken. </p> <br>
        <p>Noch einmal alle Daten zu ihrer Buchung im Überblick:</p><br><br>
        
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
