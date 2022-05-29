@extends('layouts.email')

@section('content')
<h3>Guten Tag {{ $name }},</h3>

Scheinbar hast du dein Passwort vergessen, das ist nicht weiter schlimm, wir haben dir einen Link geschickt, über den du ein neues Passwort festlegen kannst. <br />

Klicke <a href="{{$link}}">hier</a> um dein neues Passwort festzulegen <br />

PS: Solltest du keinen Link für eine Passwort-Änderung angefordert haben, dann ignoriere diese Mail einfach, wir speichern keine deiner Daten.<br />
Dein Support-Team<br />
www.Youmas.de<br />
Hierbei handelt es sich um eine automatisch generierte E-Mail einer System-Email. Bitte antworte nicht auf diese Mail.<br />

@endsection