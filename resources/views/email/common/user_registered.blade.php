@extends('layouts.email')

@section('content')

<div>
    <h3>Sehr geehrte/r, {{$name}}</h3>
    <p>Wir freuen uns über ihre Registrierung bei Youmas.de</p>

    <br />
    Nutzen sie bitte den folgenden Link zur Bestätigung ihrer Email-Adresse: <br>
    <a href="{{$link}}">Email-Adresse verifizieren</a>
    <br /><br />

    <p>Sollten sie Fragen oder Anregungen für uns haben, können sie uns gerne kontaktieren. Dazu stehen unsere Kontaktformulare bereit. Wir werden sie schnellstmöglich kontaktieren.</p>

    Ihr Team von Youmas
</div>
@endsection