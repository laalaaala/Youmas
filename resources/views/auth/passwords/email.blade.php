@extends('layouts.app')

@section('content')

<main class="flex items-center max-w-lg mx-auto md:w-3/12">
    <div class="w-full max-w-lg">
        <div class="px-12 pt-6 pb-8 mx-auto mb-4 bg-white rounded shadow-lg">
            <div class="card-body">
                <form method="POST" action="/password/email">
                    @csrf
                    <div class="flex justify-center py-2 mb-4 text-2xl font-bold text-gray-800 border-b-2">
                        Youmas - Passwort zurücksetzen
                    </div>
                    <div class="mb-6 form-group row">
                        <label class="block mb-2 font-semibold text-gray-700 text-md" for="email">
                            Email
                        </label>
                        <div class="col-md-6">
                            <input id="email" type="email" class="w-full px-3 py-2 mb-3 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @if (session('status'))
                            <div class="px-4 py-3 text-teal-900 bg-green-400 border-t-4 border-teal-500 rounded-b shadow-md" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="mb-0 form-group row">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit"
                                    class="inline-block px-4 py-2 text-white rounded shadow-lg bg-primary-400 hover:bg-secondary-400 focus:bg-secondary-400">
                                    {{ __('Passwort-Wiederherstellungslink anfordern') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
