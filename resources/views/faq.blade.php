@extends('layouts.app')

@section('content')
    <div class="w-full" id="app">
    <page-header page="Häufig gestellte Fragen" title="FAQ's"></page-header>
        <faqs-view :faqs="{{ json_encode($faqs) }}"></faqs-view>
    </div>
@endsection
