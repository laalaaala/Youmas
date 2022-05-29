<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Stripe -->
    <script src="https://js.stripe.com/v3/"></script>
    <link rel="shortcut icon" href="{{ asset('img/favicon.jpeg') }}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
</head>



<body class="flex flex-col h-screen">
    <header class="top-0 left-0 right-0 z-10 flex items-center px-6 py-10 bg-white">
        <div class="container mx-auto">
            <div class="flex items-center">
                <div class="flex-1 text-primary-400">
                    <a href="/" class="text-2xl text-bold">
                        <img src="/images/logo.png" alt="logo" width="200" class="hidden mx-auto lg:block lg:mr-auto lg:ml-0">
                        <img src="/images/logo.png" alt="logo" width="100" class="mx-auto lg:hidden lg:mr-auto lg:ml-0">
                    </a>
                </div>
                <button class="text-secondary lg:hidden" onclick="toggleMenu()">
                    <svg class="w-6 h-6 current-fill" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="-49 141 512 512" style="enable-background:new -49 141 512 512;" xml:space="preserve">
                        <g>
                            <g>
                                <path d="M413,422H1c-13.807,0-25-11.193-25-25s11.193-25,25-25h412c13.807,0,25,11.193,25,25S426.807,422,413,422z" />
                            </g>
                            <g>
                                <path d="M413,562H1c-13.807,0-25-11.193-25-25s11.193-25,25-25h412c13.807,0,25,11.193,25,25S426.807,562,413,562z" />
                            </g>
                            <g>
                                <path d="M413,282H1c-13.807,0-25-11.193-25-25s11.193-25,25-25h412c13.807,0,25,11.193,25,25S426.807,282,413,282z" />
                            </g>
                        </g>
                    </svg>

                </button>
                <nav class="items-center hidden lg:flex">
                    <a href="/" class="px-6 py-3 font-medium text-secondary-400">Home
                        <hr class="border-b border-primary-400 {{ Route::currentRouteName() == 'welcome' ? 'block' : 'hidden' }}">
                    </a>
                    <a href="/about" class="px-6 py-3 font-medium hover:border-primary-400 text-secondary-400 ">Über Youmas
                        <hr class="border-b border-primary-400 {{ Route::currentRouteName() == 'about' ? 'block' : 'hidden' }}">
                    </a>
                    <a href="/services" class="px-6 py-3 font-medium hover:border-primary-400 text-secondary-400">Dienstleistungen
                        <hr class="border-b border-primary-400  {{ Route::currentRouteName() == 'services' ? 'block' : 'hidden' }}">
                    </a>
                    <a href="/faq" class="px-6 py-3 font-medium hover:border-primary-400 text-secondary-400 ">FAQ's
                        <hr class="border-b border-primary-400 {{ Route::currentRouteName() == 'faqs' ? 'block' : 'hidden' }}">
                    </a>
                    <a href="/pricing" class="px-6 py-3 mr-3 font-medium hover:border-primary-400 text-secondary-400">Preis
                        <hr class="border-b border-primary-400  {{ Route::currentRouteName() == 'pricing' ? 'block' : 'hidden' }}">
                    </a>

                    @if (!Auth::user())
                    <a href="/register" class="w-40 px-6 py-3 font-medium text-center text-white rounded-full custom-button bg-secondary-400 hover:border-primary-400">Registrieren
                        <hr class="border-b border-primary-400  {{ Route::currentRouteName() == 'register' ? 'block' : 'hidden' }}">

                    </a>
                    <a href="/login" class="w-40 px-10 py-3 mx-3 font-medium text-center text-white rounded-full custom-button-inverted bg-primary-400 text-secondary-400">Login
                        <hr class="border-b border-secondary-400  {{ Route::currentRouteName() == 'login' ? 'block' : 'hidden' }}">

                    </a>
                    @else
                    <a href="/dashboard" class="w-40 px-6 py-3 mx-3 font-medium text-center text-white rounded-full custom-button bg-secondary-400">Dashboard</a>

                    <a href="/logout" class="w-40 px-10 py-3 mx-3 font-medium text-center text-white rounded-full custom-button-inverted bg-primary-400 text-secondary-400">Abmelden</a>
                    @endif
                </nav>
            </div>
        </div>

        <nav id="mobile-menu" class="fixed top-0 right-0 z-50 flex flex-col items-center justify-center hidden w-2/3 h-full overflow-hidden bg-white shadow-lg gap-y-5" z-index="999">
            <span>
                <i onclick="toggleMenu()" class="absolute fa fa-times top-10 right-10"></i>
            </span>
            <a href="/" class="z-0 px-6 py-3 font-medium text-secondary-400">Home
                <hr class="border-b border-primary-400 {{ Route::currentRouteName() == 'welcome' ? 'block' : 'hidden' }}">
            </a>
            <a href="/about" class="z-0 px-6 py-3 font-medium hover:border-primary-400 text-secondary-400">
                About
                <hr class="border-b border-primary-400 {{ Route::currentRouteName() == 'about' ? 'block' : 'hidden' }}">
            </a>
            <a href="/services" class="z-0 px-6 py-3 font-medium hover:border-primary-400 text-secondary-400">
                Dienstleistungen
                <hr class="border-b border-primary-400  {{ Route::currentRouteName() == 'services' ? 'block' : 'hidden' }}">
            </a>
            <a href="/faq" class="z-0 px-6 py-3 font-medium hover:border-primary-400 text-secondary-400">
                FAQ's
                <hr class="border-b border-primary-400 {{ Route::currentRouteName() == 'faqs' ? 'block' : 'hidden' }}">
            </a>


            @if (!Auth::user())
            <a href="/pricing" class="z-0 px-6 py-3 mr-3 font-medium hover:border-primary-400 text-secondary-400">
                Preis
                <hr class="border-b border-primary-400  {{ Route::currentRouteName() == 'pricing' ? 'block' : 'hidden' }}">
            </a>
            <a href="/register" class="w-40 px-6 py-3 font-medium text-center text-white rounded-full custom-button bg-secondary-400 hover:border-primary-400" style="z-index: 999;">Registrieren
                <hr class="border-b border-primary-400  {{ Route::currentRouteName() == 'register' ? 'block' : 'hidden' }}">

            </a>
            <a href="/login" class="w-40 px-10 py-3 mx-3 font-medium text-center text-white rounded-full custom-button-inverted bg-primary-400 text-secondary-400" style="z-index: 999;">Login
                <hr class="border-b border-secondary-400  {{ Route::currentRouteName() == 'login' ? 'block' : 'hidden' }}">

            </a>
            @else
            <a href="/dashboard" class="w-40 px-6 py-3 mx-3 font-medium text-center text-white rounded-full custom-button bg-secondary-400" style="z-index: 999;">Dashboard</a>

            <a href="/logout" class="w-40 px-10 py-3 mx-3 font-medium text-center text-white rounded-full custom-button-inverted bg-primary-400 text-secondary-400" style="z-index: 999;">Abmelden</a>
            @endif
        </nav>

    </header>

    <main class="flex flex-1">
        @yield('content')
    </main>

    <footer class="mt-24 mt-auto bg-secondary-500 ">
        <div class="flex flex-col items-center justify-center px-6 py-20 mx-auto text-left border-t border-gray-300 text-secondary-500">
            <a href="/" class="text-2xl text-bold ">
                <img src="/images/footer_logo.png" alt="logo" width="150">
            </a>
            <p class="mx-auto my-10 text-xl text-center text-white lg:w-1/2">
            Der Wunschtermin ist mit Youmas schnell gebucht: So einfach war die Buchung von Terminen bei Schönheitssalons und Studios rund um Beauty, Body und Co. noch nie! Youmas bietet den perfekten Rundumservice für individuelle Termine für Hairstyling, Naildesign, Tattoos und mehr.  
            </p>
            <div class="w-1/2 mx-auto text-center fex">
                <i class="mr-3 text-xl text-white fab fa-facebook-f"></i>
                <i class="mr-3 text-xl text-white fab fa-twitter"></i>
                <i class="mr-3 text-xl text-white fab fa-pinterest-p"></i>
                <i class="mr-3 text-xl text-white fab fa-instagram"></i>
                <i class="text-xl text-white fab fa-youtube"></i>
            </div>
            <nav class="items-center justify-center mx-auto mt-10 lg:hidden">
                <a href="/about" class="w-1/4 px-3 py-3 text-sm font-medium text-white border-b-2 border-transparent hover:border-primary-400 hover:text-primary-400">
                    Über Youmas
                </a>
                <a href="/services" class="w-1/4 px-3 py-3 text-sm font-medium text-white border-b-2 border-transparent hover:border-primary-400 hover:text-primary-400">
                    Dienstleistungen
                </a>
                <a href="/faqs" class="w-1/4 px-3 py-3 text-sm font-medium text-white border-b-2 border-transparent hover:border-primary-400 hover:text-primary-400">
                    FAQ's
                </a>
                <a href="/pricing" class="w-1/4 px-3 py-3 text-sm font-medium text-white border-b-2 border-transparent hover:border-primary-400 hover:text-primary-400">
                    Preis
                </a>
            </nav>
        </div>
        <div class="border-t border-gray-300 ">
            <div class="container flex max-w-6xl px-6 py-5 mx-auto text-left text-secondary-500">
                <p class="flex items-center justify-center w-full text-center text-white lg:hidden text-md lg:text-lg">© Copyright 2021 www.youmas.de <br> All rights reserved.</p>

                <p class="flex items-center hidden w-1/2 text-lg text-white lg:flex">© Copyright 2021 www.youmas.de All rights reserved.</p>
                <nav class="items-center justify-center hidden w-1/2 ml-auto lg:flex">
                    <a href="/about" class="px-6 py-3 text-lg font-medium text-white border-b-2 border-transparent hover:border-primary-400 hover:text-primary-400">
                        Über Youmas
                    </a>
                    <a href="/services" class="px-6 py-3 text-lg font-medium text-white border-b-2 border-transparent hover:border-primary-400 hover:text-primary-400">
                        Dienstleistungen
                    </a>
                    <a href="/faqs" class="px-6 py-3 text-lg font-medium text-white border-b-2 border-transparent hover:border-primary-400 hover:text-primary-400">
                        FAQ's
                    </a>
                    <a href="/pricing" class="py-3 pl-6 text-lg font-medium text-white border-b-2 border-transparent hover:border-primary-400 hover:text-primary-400">
                        Preis
                    </a>
                </nav>
            </div>
        </div>
    </footer>

</body>

</html>

<script>
    function toggleMenu() {
        document.querySelector('#mobile-menu').classList.toggle('hidden');
    }
</script>