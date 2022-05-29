@extends('layouts.email')

@section('content')
<div>
    <h3>Sehr geehrte/r, {{ $name }}: </h3>
    <p>Du hast erfolgreich ein neues Passwort für dein Youmas Konto erstellt.</p> <br />

    Sollte dir diese Änderung unbekannt sein, kontaktiere bitte unverzüglich unser Support-Team.
    <br>
    <br>

    Viele Grüße,
    <br>
    Youmas.
</div>
@endsection