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
    <!-- Stripe -->
    <script src="https://js.stripe.com/v3/"></script>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">



    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
</head>

<body class="items-center h-screen min-h-screen">
    <header class="top-0 left-0 right-0 z-10 flex items-center px-6 py-10 bg-white">
        <div class="container mx-auto">
            <div class="flex items-center">
                <div class="flex-1 text-primary-400">
                    <a href="/" class="text-2xl text-bold">
                        <img src="/images/logo.png" alt="logo" width="200" class="hidden mx-auto lg:block lg:mr-auto lg:ml-0">
                        <img src="/images/logo.png" alt="logo" width="100" class="mx-auto lg:hidden lg:mr-auto lg:ml-0"> </a>
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
                    <a href="/about" class="px-6 py-3 font-medium hover:border-primary-400 text-secondary-400 ">Über Uns
                        <hr class="border-b border-primary-400 {{ Route::currentRouteName() == 'about' ? 'block' : 'hidden' }}">
                    </a>
                    <a href="/services" class="px-6 py-3 font-medium hover:border-primary-400 text-secondary-400">Dienstleistungen
                        <hr class="border-b border-primary-400  {{ Route::currentRouteName() == 'services' ? 'block' : 'hidden' }}">
                    </a>
                    <a href="/faq" class="px-6 py-3 font-medium hover:border-primary-400 text-secondary-400 ">FAQ's
                        <hr class="border-b border-primary-400 {{ Route::currentRouteName() == 'faqs' ? 'block' : 'hidden' }}">
                    </a>

                    @if (!Auth::user())
                    <a href="/pricing" class="px-6 py-3 mr-3 font-medium hover:border-primary-400 text-secondary-400">Preis
                        <hr class="border-b border-primary-400 {{ Route::currentRouteName() == 'pricing' ? 'block' : 'hidden' }}">
                    </a>
                    <a href="/register" class="w-40 px-6 py-3 font-medium text-center text-white rounded-full custom-button bg-secondary-400 hover:border-primary-400">Registrieren </a>
                    <a href="/login" class="w-40 px-10 py-3 mx-3 font-medium text-center text-white rounded-full custom-button-inverted bg-primary-400 text-secondary-400">Login</a>
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
            <a href="/about" class="z-0 px-6 py-3 font-medium hover:border-primary-400 text-secondary-400">Über Uns
                <hr class="border-b border-primary-400 {{ Route::currentRouteName() == 'about' ? 'block' : 'hidden' }}">
            </a>
            <a href="/services" class="z-0 px-6 py-3 font-medium hover:border-primary-400 text-secondary-400">Dienstleistungen
                <hr class="border-b border-primary-400  {{ Route::currentRouteName() == 'services' ? 'block' : 'hidden' }}">
            </a>
            <a href="/faq" class="z-0 px-6 py-3 font-medium hover:border-primary-400 text-secondary-400">FAQ's
                <hr class="border-b border-primary-400 {{ Route::currentRouteName() == 'faqs' ? 'block' : 'hidden' }}">
            </a>
            <a href="/pricing" class="z-0 px-6 py-3 mr-3 font-medium hover:border-primary-400 text-secondary-400">Preis
                <hr class="border-b border-primary-400  {{ Route::currentRouteName() == 'pricing' ? 'block' : 'hidden' }}">
            </a>

            @if (!Auth::user())
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
        <nav id="mobile-menu" class="fixed top-0 right-0 z-50 flex flex-col items-center justify-center hidden w-2/3 h-full overflow-hidden bg-white shadow-lg gap-y-5" z-index="999">
            <span>
                <i onclick="toggleMenu()" class="absolute fa fa-times top-10 right-10"></i>
            </span>
            <a href="/" class="z-0 px-6 py-3 font-medium text-secondary-400">Home
                <hr class="border-b border-primary-400 {{ Route::currentRouteName() == 'welcome' ? 'block' : 'hidden' }}">
            </a>
            <a href="/about" class="z-0 px-6 py-3 font-medium hover:border-primary-400 text-secondary-400">Über Uns
                <hr class="border-b border-primary-400 {{ Route::currentRouteName() == 'about' ? 'block' : 'hidden' }}">
            </a>
            <a href="/services" class="z-0 px-6 py-3 font-medium hover:border-primary-400 text-secondary-400">Dienstleistungen
                <hr class="border-b border-primary-400  {{ Route::currentRouteName() == 'services' ? 'block' : 'hidden' }}">
            </a>
            <a href="/faq" class="z-0 px-6 py-3 font-medium hover:border-primary-400 text-secondary-400">FAQ's
                <hr class="border-b border-primary-400 {{ Route::currentRouteName() == 'faqs' ? 'block' : 'hidden' }}">
            </a>
            <a href="/pricing" class="z-0 px-6 py-3 mr-3 font-medium hover:border-primary-400 text-secondary-400">Preis
                <hr class="border-b border-primary-400  {{ Route::currentRouteName() == 'pricing' ? 'block' : 'hidden' }}">
            </a>

            @if (!Auth::user())
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
    <main>

        <body class="tracking-normal tracking-wider bg-gray-100" data-new-gr-c-s-check-loaded="14.990.0" data-gr-ext-installed="" cz-shortcut-listen="true">

            <!--Container-->
            <div class="flex flex-wrap w-full px-5 pt-8 mx-auto lg:px-10 lg:mt-0 lg:pt-0">
                @if(Auth::user()->login_as && Auth::user()->login_as == Cookie::get('logged_in_token'))
                <div class="absolute left-0 flex flex-row items-center justify-center w-full h-16 p-3 text-black bg-primary-400 top-20">
                    <span>You are logged in as {{Auth::user()->email}}</span>
                    <a class="p-1 ml-3 font-bold uppercase bg-black rounded text-primary-400" href="/end-session">Abmelden</a>
                </div>
                @endif
                @if (Auth::user()->type == 'business' && Auth::user()->subscription || Auth::user()->type != 'business')
                <div class="w-full text-xl leading-normal text-center text-gray-800 lg:pl-10 xl:pl-16 lg:my-10 lg:text-left lg:w-3/12 shadow-r-md lg:pt-16">
                    <p class="py-2 text-2xl text-secondary-400 lg:pb-6 lg:text-4xl ">Dashboard</p>
                    <div class="sticky inset-0 block lg:hidden" style="z-index: 0; ">
                        <button id="menu-toggle" class="flex items-center justify-center w-1/2 px-3 py-3 mx-auto bg-transparent rounded appearance-none lg:bg-transparent focus:outline-none">
                            @if( Request::path() == 'dashboard')
                            <span class="ml-auto mr-2 text-sm">Mein Profil</span>
                            @elseif( Request::path() == 'dashboard/bookings')
                            <span class="ml-auto mr-2 text-sm">Meine Buchungen</span>
                            @elseif( Request::path() == 'dashboard/support')
                            <span class="ml-auto mr-2 text-sm">Support</span>
                            @else
                            <span class="ml-auto mr-2 text-sm">Favoriten</span>

                            @endif
                            <svg class="h-3 mr-auto fill-current" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z">
                                </path>
                            </svg>
                        </button>
                    </div>
                    <div class="sticky inset-0 z-20 hidden w-full h-40 mt-0 overflow-x-hidden overflow-y-auto bg-white lg:h-auto lg:overflow-y-hidden lg:block border-secondary-400 lg:border-transparent lg:shadow-none lg:bg-transparent" style="top:5em;" id="menu-content">
                        <ul class="list-reset">
                            @if (Auth::user()->type == 'business' && Auth::user()->subscription)
                            <li class="py-2 md:my-0 hover:bg-purple-100 lg:hover:bg-transparent">

                                <a href="/dashboard" class="block pl-4 text-gray-700 no-underline align-middle border-l-4 border-transparent hover:text-primary-400 lg:hover:border-primary-400 {{ Request::path() == 'dashboard' ? 'lg:border-primary-400' : '' }}">
                                    <span class="pb-1 text-sm font-bold text-gray-900 md:pb-0">Unternehmensprofil</span>
                                </a>
                            </li>
                            <li class="py-2 md:my-0 hover:bg-purple-100 lg:hover:bg-transparent">
                                <a href="/dashboard/services" class="block pl-4 text-gray-700 no-underline align-middle border-l-4 border-transparent hover:text-primary-400 lg:hover:border-secondary-400 {{ Request::path() == 'dashboard/services' ? 'lg:border-primary-400' : '' }}">
                                    <span class="pb-1 text-sm md:pb-0">Dienstleistungen</span>
                                </a>
                            </li>
                            <li class="py-2 md:my-0 hover:bg-purple-100 lg:hover:bg-transparent">

                                <a href="/dashboard/employees" class="block pl-4 text-gray-700 no-underline align-middle border-l-4 border-transparent hover:text-primary-400 lg:hover:border-secondary-400 {{ Request::path() == 'dashboard/employees' ? 'lg:border-primary-400' : '' }}">
                                    <span class="pb-1 text-sm md:pb-0">Mitarbeiter</span>
                                </a>
                            </li>
                            <li class="py-2 md:my-0 hover:bg-purple-100 lg:hover:bg-transparent">
                                <a href="/dashboard/planning-calendar" class="block pl-4 text-gray-700 no-underline align-middle border-l-4 border-transparent hover:text-primary-400 lg:hover:border-secondary-400 {{ Request::path() == 'dashboard/planning-calendar' ? 'lg:border-primary-400' : '' }}">
                                    <span class="pb-1 text-sm md:pb-0">Planungen</span>
                                </a>
                            </li>
                            <li class="py-2 md:my-0 hover:bg-purple-100 lg:hover:bg-transparent">
                                <a href="/dashboard/booking-calendar" class="block pl-4 text-gray-700 no-underline align-middle border-l-4 border-transparent hover:text-primary-400 lg:hover:border-secondary-400 {{ Request::path() == 'dashboard/booking-calendar' ? 'lg:border-primary-400' : '' }}">
                                    <span class="pb-1 text-sm md:pb-0">Buchungen</span>
                                </a>
                            </li>
                            <li class="py-2 md:my-0 hover:bg-purple-100 lg:hover:bg-transparent">
                                <a href="/dashboard/statistics" class="block pl-4 text-gray-700 no-underline align-middle border-l-4 border-transparent hover:text-primary-400 lg:hover:border-secondary-400 {{ Request::path() == 'dashboard/statistics' ? 'lg:border-primary-400' : '' }}">
                                    <span class="pb-1 text-sm md:pb-0">Statistiken</span>
                                </a>
                            </li>
                            <li class="py-2 md:my-0 hover:bg-purple-100 lg:hover:bg-transparent">
                                <a href="/dashboard/support" class="block pl-4 text-gray-700 no-underline align-middle border-l-4 border-transparent hover:text-primary-400 lg:hover:border-secondary-400 {{ Request::path() == 'dashboard/support' ? 'lg:border-primary-400' : '' }}">
                                    <span class="pb-1 text-sm md:pb-0">Support</span>
                                </a>
                            </li>
                            <li class="py-2 md:my-0 hover:bg-purple-100 lg:hover:bg-transparent">
                                <a href="/businesses/subscriptions" class="block pl-4 text-gray-700 no-underline align-middle border-l-4 border-transparent hover:text-primary-400 lg:hover:border-secondary-400 {{ Request::path() == 'businesses/subscriptions' ? 'lg:border-primary-400' : '' }}">
                                    <span class="pb-1 text-sm md:pb-0">Plans</span>
                                </a>
                            </li>
                            @endif
                            @if (Auth::user()->type == 'customer')
                            <li class="py-2 md:my-0 hover:bg-purple-100 lg:hover:bg-transparent">
                                <a href="/dashboard" class="block pl-0 text-gray-700 no-underline align-middle border-l-4 border-transparent hover:text-primary-400">
                                    <i class="h-5 mr-4 far fa-user"></i>
                                    <span class="pb-1 text-sm md:pb-0 {{ Request::path() == 'dashboard' ? 'lg:border-primary-400 border-b-2' : '' }}">Mein Profil</span>
                                </a>
                            </li>
                            <li class="py-2 md:my-0 hover:bg-purple-100 lg:hover:bg-transparent">
                                <a href="/dashboard/bookings" class="block pl-0 text-gray-700 no-underline align-middle border-l-4 border-transparent hover:text-primary-400">
                                    <i class="h-5 mr-4 fas fa-book"></i>
                                    <span class="pb-1 text-sm md:pb-0 {{ Request::path() == 'dashboard/bookings' ? 'lg:border-primary-400 border-b-2' : '' }}">Meine Buchungen</span>
                                </a>
                            </li>
                            <li class="py-2 md:my-0 hover:bg-purple-100 lg:hover:bg-transparent">
                                <a href="/dashboard/support" class="block pl-0 text-gray-700 no-underline align-middle border-l-4 border-transparent hover:text-primary-400">
                                    <i class="h-5 mr-4 fas fa-headphones-alt"></i>
                                    <span class="pb-1 text-sm md:pb-0 {{ Request::path() == 'dashboard/support' ? 'lg:border-primary-400 border-b-2' : '' }}">Support</span>
                                </a>
                            </li>
                            <li class="py-2 md:my-0 hover:bg-purple-100 lg:hover:bg-transparent">
                                <a href="/dashboard/favorites" class="block pl-0 text-gray-700 no-underline align-middle border-l-4 border-transparent hover:text-primary-400">
                                    <i class="h-5 mr-4 far fa-heart"></i>
                                    <span class="pb-1 text-sm md:pb-0 {{ Request::path() == 'dashboard/favorites' ? 'lg:border-primary-400 border-b-2' : '' }}">Favoriten</span>
                                </a>
                            </li>
                            @endif
                            @if (Auth::user()->type == 'admin')
                            <li class="py-2 md:my-0 hover:bg-purple-100 lg:hover:bg-transparent">
                                <a href="/dashboard" class="block pl-4 text-gray-700 no-underline align-middle border-l-4 border-transparent hover:text-primary-400 lg:hover:border-secondary-400 {{ Request::path() == 'dashboard' ? 'lg:border-primary-400' : '' }}">
                                    <span class="pb-1 text-sm md:pb-0">Mein Profil</span>
                                </a>
                            </li>
                            <li class="py-2 md:my-0 hover:bg-purple-100 lg:hover:bg-transparent">
                                <a href="/admin/users" class="block pl-4 text-gray-700 no-underline align-middle border-l-4 border-transparent hover:text-primary-400 lg:hover:border-secondary-400 {{ Request::path() == 'admin/users' ? 'lg:border-primary-400' : '' }}">
                                    <span class="pb-1 text-sm md:pb-0">Users</span>
                                </a>
                            </li>
                            <li class="py-2 md:my-0 hover:bg-purple-100 lg:hover:bg-transparent">
                                <a href="/admin/faqs" class="block pl-4 text-gray-700 no-underline align-middle border-l-4 border-transparent hover:text-primary-400 lg:hover:border-secondary-400 {{ Request::path() == 'dashboard/bookings' ? 'lg:border-primary-400' : '' }}">
                                    <span class="pb-1 text-sm md:pb-0">Faqs</span>
                                </a>
                            </li>
                            <li class="py-2 md:my-0 hover:bg-purple-100 lg:hover:bg-transparent">
                                <a href="/admin/stats" class="block pl-4 text-gray-700 no-underline align-middle border-l-4 border-transparent hover:text-primary-400 lg:hover:border-secondary-400 {{ Request::path() == 'dashboard/bookings' ? 'lg:border-primary-400' : '' }}">
                                    <span class="pb-1 text-sm md:pb-0">Stats</span>
                                </a>
                            </li>
                            <li class="py-2 md:my-0 hover:bg-purple-100 lg:hover:bg-transparent">
                                <a href="/admin/transactions" class="block pl-4 text-gray-700 no-underline align-middle border-l-4 border-transparent hover:text-primary-400 lg:hover:border-secondary-400 {{ Request::path() == 'dashboard/bookings' ? 'lg:border-primary-400' : '' }}">
                                    <span class="pb-1 text-sm md:pb-0">Transactions</span>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
                @endif


                @if (Auth::user()->type == 'business' && Auth::user()->subscription || Auth::user()->type != 'business')
                <div class="w-full min-h-screen leading-normal text-gray-900 bg-white lg:my-10 lg:w-9/12 lg:my-0 border-rounded">
                    @yield('content')
                </div>
                @else
                <div class="w-full h-full px-4 my-10 leading-normal text-gray-900 bg-white lg:w-full lg:mt-0 border-rounded">
                    @yield('content')
                </div>
                @endif
            </div>
            <script>
                /*Toggle dropdown list*/
                /*https://gist.github.com/slavapas/593e8e50cf4cc16ac972afcbad4f70c8*/

                var navMenuDiv = document.getElementById("nav-content");
                var navMenu = document.getElementById("nav-toggle");

                var helpMenuDiv = document.getElementById("menu-content");
                var helpMenu = document.getElementById("menu-toggle");

                document.onclick = check;

                function check(e) {
                    var target = (e && e.target) || (event && event.srcElement);


                    //Nav Menu
                    if (!checkParent(target, navMenuDiv)) {
                        // click NOT on the menu
                        if (checkParent(target, navMenu)) {
                            // click on the link
                            if (navMenuDiv.classList.contains("hidden")) {
                                navMenuDiv.classList.remove("hidden");
                            } else {
                                navMenuDiv.classList.add("hidden");
                            }
                        } else {
                            // click both outside link and outside menu, hide menu
                            if (navMenuDiv != null) {
                                navMenuDiv.classList.add("hidden");
                            }
                        }
                    }

                    //Help Menu
                    if (!checkParent(target, helpMenuDiv)) {
                        // click NOT on the menu
                        if (checkParent(target, helpMenu)) {
                            // click on the link
                            if (helpMenuDiv.classList.contains("hidden")) {
                                helpMenuDiv.classList.remove("hidden");
                            } else {
                                helpMenuDiv.classList.add("hidden");
                            }
                        } else {
                            // click both outside link and outside menu, hide menu
                            if (navMenuDiv != null) {

                                helpMenuDiv.classList.add("hidden");
                            }
                        }
                    }

                }

                function checkParent(t, elm) {
                    while (t.parentNode) {
                        if (t == elm) {
                            return true;
                        }
                        t = t.parentNode;
                    }
                    return false;
                }
            </script>

            <script src="chrome-extension://dadggmdmhmfkpglkfpkjdmlendbkehoh/inject-scripts/searchvideos.js" async=""></script>
        </body>
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
                    Über Uns
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
                        Über Uns
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