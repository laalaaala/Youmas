@extends('layouts.app')

@section('content')
<main class="flex flex-col items-center max-w-lg mx-auto 2xl:w-3/12 h-100 gap-y-5">

    @if(app('request')->input('verify'))
    <div class="flex items-center px-4 py-3 text-sm font-bold text-white bg-blue-500" role="alert">
        <svg class="w-4 h-4 mr-2 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" />
        </svg>
        <p class="text-white">Wir haben Ihnen eine E-Mail geschickt. Sie müssen Ihr Konto verifizieren, bevor Sie sich anmelden können.</p>
    </div>

    @endif

    <div class="w-full max-w-lg">
        <form method="POST" action="/login" class="px-12 pt-6 pb-8 mb-4 bg-white rounded shadow-lg">
            @csrf
            <!-- @csrf -->
            <div class="flex justify-center py-2 mb-4 text-2xl font-bold text-gray-800 border-b-2">
                Youmas - Login
            </div>
            <div class="mb-4">
                <label class="block mb-2 font-semibold text-gray-700 text-md" for="email">
                    Email
                </label>
                <input class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" name="email" type="email" required autofocus placeholder="Email" />
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="mb-6">
                <label class="block mb-2 font-semibold text-gray-700 text-md" for="password">
                    Passwort
                </label>
                <input class="w-full px-3 py-2 mb-3 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" type="password" placeholder="Password" name="password" required autocomplete="current-password" />
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="flex items-center justify-between">
                <button class="inline-block px-4 py-2 text-white rounded shadow-lg bg-primary-400 hover:bg-secondary-400 focus:bg-secondary-400" type="submit">Anmelden</button>
                <a class="inline-block text-sm font-normal align-baseline text-secondary-400 hover:text-primary-400" href="/password/reset">
                    Passwort vergessen ?
                </a>
            </div>
        </form>
        <p class="text-lg text-center text-secondary-400">
            Haben Sie keinen Account ?  <a href="/register" class="font-bold text-primary-400">Dann registrieren Sie sich.</a>
        </p>
    </div>


</main>

@endsection