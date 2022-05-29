@extends('layouts.dashboard')

@section('content')
<div id="app">
    <admin-profile :user="{{ json_encode($user) }}"></admin-profile>
</div>
@endsection