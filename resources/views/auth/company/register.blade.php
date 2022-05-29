@extends('layouts.app')

@section('content')

<main class="max-w-lg mx-auto ">
    <div class="p-8 my-10 bg-white rounded-lg shadow-2xl">
        <section class="text-center">
            <div class="flex-1 text-primary-400">
                <a class="text-2xl font-bold" href="/">YOUMAS</a>
            </div>
            <h3 class="mt-4 text-3xl font-bold">Erstellen Sie ihren persönlichen Account</h3>
            <!-- <p class="pt-2 text-gray-600">Register your account.</p> -->
        </section>

        <section class="mt-10">
            <div id="app">
                <business-register-view></business-register-view>
            </div>
        </section>
    </div>
    <div class="max-w-lg mx-auto mt-12 mb-6 mb-10 text-center">
        <p class="text-primary-400">Haben Sie schon einen Account ?  <a href="/login" class="font-bold hover:underline">Sie sich ein?</a>.</p>
    </div>
</main>

@endsection