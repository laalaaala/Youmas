@extends('layouts.email')

@section('content')


<div>
    <h3>Hallo Admin,</h3>
    du hast folgende Nachricht erhalten.<br><br>

    <strong>Email:</strong> {{ $email }}<br>
    <strong>Nutzertyp:</strong> {{$name}}<br>
    <strong>Timestamp:</strong> {{$timestamp}}<br>
    <strong>Nachricht:</strong> {{$msg}}<br><br>

    Bitte überprüfe den Eingang und antworte schnellst möglich.
</div>
@endsection