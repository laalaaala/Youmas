@extends('layouts.app')

@section('content')
<main class="max-w-lg md:w-3/12 mx-auto flex items-center">
    <div class="w-full max-w-lg">
        <div class="bg-white shadow-lg rounded px-12 pt-6 pb-8 mb-4 mx-auto">
            <div class="card-body">
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <div class="text-gray-800 text-2xl flex justify-center border-b-2 py-2 mb-4 font-bold">
                        Youmas - Reset Password
                    </div>

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group row">
                        <label class="block text-gray-700 text-md font-semibold mb-2" for="email">
                            Email
                        </label>
                        <div class="col-md-6">
                            <input id="email" type="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="block text-gray-700 text-md font-semibold mb-2">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" name="password" required autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-6">
                        <label for="password-confirm" class="block text-gray-700 text-md font-semibold mb-2">{{ __('Confirm Password') }}</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="px-4 py-2 rounded text-white inline-block shadow-lg bg-primary-400 hover:bg-secondary-400 focus:bg-secondary-400">
                                {{ __('Reset Password') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection