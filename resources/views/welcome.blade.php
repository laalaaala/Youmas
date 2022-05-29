@extends('layouts.app')

@section('content')
<div class="flex flex-col w-full">
    <div class="relative pb-18" id="app">
        <div class="relative w-full mx-auto text-center">
            <div class="flex flex-col items-centermd:flex-row md:pb-0">
                <div id="hero" class="relative flex items-center justify-center hidden w-full mb-4 lg:flex sm:mb-16 md:mb-0" style="height: 745px">
                    <div class="container flex flex-col py-20 text-left xl:ml-20 h-96 gap-y-5 lg:pl-5 xl:pl-10 lg:pt-24">

                        <!-- <img src="/images/home/header-image.png" class="absolute top-0 right-0 z-20 " height="100%">
                            <img src="/images/home/element-hero.png" class="absolute top-0 right-0 z-40 left-20" width="20%" alt=""> -->
                        <h1 class="z-50 text-6xl">Willkommen <br />Mehr Buchungen mit Youmas</h1>
                        <p class="z-50 text-2xl font-normal text-black font-playfair">Ganz einfach Service rund um Beauty und Body buchen
                        </p>
                        <div class="z-50 flex flex-col">
                            <business-simple-filter></business-simple-filter>
                        </div>
                    </div>
                </div>
                <div id="hero-mobile" class="relative flex items-center justify-center w-full mb-4 mb-16 lg:hidden sm:mb-16 md:mb-0 lg:mb-0">
                    <div class="container flex flex-col overflow-hidden text-center lg:py-20 lg:pl-10 lg:pt-24">
                        <div class="relative mb-10 h-52 lg:h-96 md:mb-52 lg:mb-0">
                            <img src="/images/home/mobile-hero.png" class="absolute top-0 left-0 mb-16 lg:hidden md:w-full" style="z-index: 0;">
                            <img src="/images/home/element-hero.png" class="absolute -right-10 top-16 lg:top-80" width="66%" alt="" style="z-index: -1;">
                        </div>
                        <h1 class="-mb-10 font-bold uppercase lg:hidden text-9xl opacity-5 " style="font: normal normal 900 40px/60px Poppins; z-index: 0;">
                            Youmas
                        </h1>
                        <h1 class="hidden -mb-20 font-bold uppercase lg:block lg:text-5xl opacity-5" style="font: normal normal 900 86px/129px Poppins; ">
                            Youmas
                        </h1>
                        <h1 class="text-2xl lg:text-7xl" style="z-index: 0;">Willkommen <br /> Mehr Buchungen mit Youmas</h1>
                        <p class="text-sm font-medium text-black lg:text-2xl font-playfair" style="z-index: 0;">Ganz einfach Service rund um Beauty und Body buchen</p>
                        <div class="flex flex-col px-10" style="z-index: 0;">
                            <business-simple-filter></business-simple-filter>

                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:py-32">
                <how></how>
            </div>
            <div class="relative py-16 my-10 lg:mt-0 lg:mb-24" id="about">
                <div class="flex flex-col mx-auto max-w-7xl gap-x-10 gap-y-10 lg:pb-10">
                    <div class="flex flex-col md:flex-row gap-x-24">
                        <div class="hidden w-full lg:block md:w-1/2">
                            <img class="absolute top-0 hidden lg:block " src="/images/home/about-image.png" alt="" />
                        </div>
                        <div class="flex flex-col w-full text-center lg:w-1/4 xl:w-2/3 lg:gap-y-7">
                            <h1 class="px-10 -mb-10 font-bold uppercase lg:hidden text-8xl opacity-5 lg:-mb-16 lg:px-0" style="font: normal normal 900 40px/60px Poppins">
                                about
                            </h1>
                            <h1 class="hidden px-10 font-bold text-left uppercase lg:block text-8xl opacity-5 -mb-28 lg:px-0" style="font: normal normal 900  86px/129px Poppins">
                                about
                            </h1>
                            <h3 class="mx-auto text-2xl font-normal text-left lg:text-5xl">
                                Über Uns
                            </h3>
                            <p class="relative px-10 mb-5 text-xs text-center text-black lg:text-left md:text-lg lg:text-base font-playfair text-md lg:px-0 lg:mb-0 ">
                                Mit dem Online-Terminbuchungssystem von Youmas.de bringen wir Kunden und Dienstleister in der Beauty Branche zusammen. Mit der einfachen Terminverwaltung schaffen wir User-Experience auf höchstem Niveau und ermitteln das perfekte Matching zwischen Suchintention und freien Kapazitäten. Wir von Youmas.de haben uns zur Aufgabe gemacht, die Digitalisierung in der Beauty Branche voranzutreiben. Das bedeutet für Kunden eine riesige Auswahl an Salons und freien Terminen und für Salonbetreiber eine optimale Auslastung Ihres Geschäfts.
                            </p>
                          <img src="/images/common/about/about-banner-mobile.png" class="w-full my-5 lg:hidden" alt="" />

                            <a href="/about" class="w-40 px-6 py-3 mx-auto mt-10 font-medium text-center text-white rounded-full lg:ml-0 custom-button bg-secondary-400">Mehr Dazu</a>

                        </div>
                    </div>
                </div>
            </div>

            <div id="service" class="pb-10 mb-16 ">
                <div class="px-6 mx-auto">
                    <div class="flex flex-col text-center lg:mt-44">
                        <div class="my-10 mb-16">

                            <h1 class="-mb-10 font-bold uppercase lg:hidden text-9xl opacity-5" style="font: normal normal 900 40px/60px Poppins">
                                Services
                            </h1>
                            <h1 class="hidden -mb-20 font-bold uppercase lg:block lg:text-5xl opacity-5" style="font: normal normal 900 86px/129px Poppins;">
                                Services
                            </h1>
                            <h2 class="text-3xl font-normal lg:text-5xl">Youmas Services</h2>
                        </div>
                        <div class="flex flex-col items-center mx-auto lg:flex-row lg:items-end lg:ml-auto gap-x-5">
                            <div id="hairdresser" class="relative flex flex-col items-start justify-end w-full h-64 p-10 my-5 text-white bg-red-500 rounded-xl lg:my-0 lg:w-1/4 xl:w-64">
                                <div class="absolute top-0 left-0 w-full h-full bg-opacity-50 rounded-xl bg-gradient-to-t from-transparent to-transparent hover:from-primary-400" style="z-index: 0;">
                                </div>
                                <a href="/businesses?branch=1&radius=5" class="text-2xl cursor-pointer" style="z-index: 0;">Friseure</a>
                                <a href="/businesses?branch=1&radius=5" class="z-50 text-xs cursor-pointer learn-more">Mehr Dazu</a>
                            </div>
                            <div id="nails" class="relative flex flex-col items-start justify-end w-full h-64 p-10 my-5 text-white bg-red-500 rounded-xl lg:my-0 lg:w-1/4 xl:w-64">
                                <div class="absolute top-0 left-0 w-full h-full bg-opacity-50 bg-gradient-to-t from-transparent to-transparent hover:from-primary-400" style="z-index: 0;">
                                </div>
                                <a href="/businesses?branch=2&radius=5" class="text-2xl cursor-pointer" style="z-index: 0;">Beauty</a>
                                <a href="/businesses?branch=2&radius=5" class="z-50 text-xs cursor-pointer learn-more">Mehr Dazu</a>
                            </div>

                            <div id="massage" class="relative flex flex-col items-start justify-end w-full h-64 p-10 my-5 text-white bg-red-500 rounded-xl lg:my-0 lg:w-1/4 xl:w-64">
                                <div class="absolute top-0 left-0 w-full h-full bg-opacity-50 bg-gradient-to-t from-transparent to-transparent hover:from-primary-400" style="z-index: 0;">
                                </div>
                                <a href="/businesses?branch=4&radius=5" class="text-2xl cursor-pointer" style="z-index: 0;">Massage</a>
                                <a href="/businesses?branch=4&radius=5" class="z-50 text-xs cursor-pointer learn-more">Mehr Dazu</a>

                            </div>
                            <div id="tattoo" class="relative flex flex-col items-start justify-end w-full h-64 p-10 my-5 text-white bg-red-500 rounded-xl lg:my-0 lg:w-1/4 xl:w-64">
                                <div class="absolute top-0 left-0 w-full h-full bg-opacity-50 tattoo bg-gradient-to-t from-transparent to-transparent hover:from-primary-400" style="z-index: 0;">
                                </div>
                                <a href="/businesses?branch=2&radius=5" class="text-2xl cursor-pointer" style="z-index: 0;">Tattoo</a>
                                <a href="/businesses?branch=2&radius=5" class="z-50 text-xs cursor-pointer learn-more">Mehr Dazu</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <icons></icons>
            <!-- <register-carousel></register-carousel>
            <services-carousel></services-carousel> -->
        </div>
    </div>
    @endsection

    <style>
        #hero {
            background: url('/images/home/hero.png');
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
        }

        @media (min-width: 1024px) and (max-width: 1024px) {
            #hero {
                background-size: contain;
            }
        }

        #about {
            background: url('/images/home/about-background.png');
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
        }


        #hairdresser {
            background: url('/images/home/hairdresser.png');
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
        }

        #tattoo {
            background: url('/images/home/tattoo.png');
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
        }

        #massage {
            background: url('/images/home/massage.png');
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
        }

        #nails {
            background: url('/images/home/nails.png');
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
        }

        .learn-more {
            display: none;
        }

        #tattoo:hover>.learn-more {
            display: block !important;
        }

        #hairdresser:hover>.learn-more {
            display: block !important;
        }

        #nails:hover>.learn-more {
            display: block !important;
        }

        #massage:hover>.learn-more {
            display: block !important;
        }
    </style>