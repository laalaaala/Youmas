@extends('layouts.app')

@section('content')
<div class="relative px-6 pt-16 overflow-hidden pb-36" id="app">
    <div class="container relative w-full mx-auto text-center">
        <div class="flex flex-col items-center pt-32 md:flex-row md:pb-0">
            <div class="w-full mb-4 sm:mb-16 md:mb-0">
                <img src="/images/hero.svg" class="mx-auto" width="250">
                <p class="mt-10 text-xl">Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt at architecto eaque, velit aperiam, incidunt excepturi repudiandae id doloremque iusto molestiae ut! At accusamus facilis aperiam itaque culpa esse cupiditate animi consequatur aspernatur ipsam vitae non pariatur quibusdam labore sint dolorum laborum natus, sit facere aliquid temporibus. Quaerat, quo! Impedit rem incidunt aspernatur laboriosam molestias, blanditiis omnis temporibus voluptatum optio!</p>
                <div class="flex flex-col px-8 pt-6 pt-10 pb-8 my-2 mb-4 bg-white rounded shadow-md">
                    <div class="mb-6 -mx-3 md:flex">
                        <div class="px-3 mb-6 md:w-2/3 md:mb-0">
                            <input class="block w-full px-4 py-3 mb-3 border rounded appearance-none bg-grey-lighter text-grey-darker border-red" id="grid-first-name" type="text" placeholder="Deine PLZ">
                        </div>
                        <div class="px-3 md:w-1/3">
                            <div class="relative">
                                <select class="block w-full px-4 py-3 pr-8 border rounded appearance-none bg-grey-lighter border-grey-lighter text-grey-darker" id="grid-state">
                                    <option>Beauty Saloons</option>
                                    <option>Hairdressers</option>
                                </select>
                                <div class="absolute flex items-center px-2 pointer-events-none pin-y pin-r text-grey-darker" style="top: 0 !important; right: 0">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="our-process" class="relative">
    <img src="/images/circle2.svg" class="absolute top-0 left-0 hidden -mx-32 sm:block">
    <div class="container relative px-6 pt-6 pb-12 mx-auto">
        <div class="flex flex-col text-center md:flex-row xl:px-32">
            <div class="flex flex-col items-center md:px-6 lg:px-12">
                <img src="https://picsum.photos/150/150" alt="">
                <h4 class="my-5 mb-2 text-2xl font-semibold text-secondary">Deine Frisöre</h4>
                <p class="leading-relaxed text-center text-secondary-700">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam imperdiet est</p>
            </div>
            <div class="flex flex-col items-center md:px-6 lg:px-12">
                <img src="https://picsum.photos/150/150" alt="">
                <h4 class="my-5 mb-2 text-2xl font-semibold text-secondary">Schnelle Terminvergabe</h4>
                <p class="leading-relaxed text-center text-secondary-700">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam imperdiet est</p>
            </div>
            <div class="flex flex-col items-center md:px-6 lg:px-12">
                <img src="https://picsum.photos/150/150" alt="">
                <h4 class="my-5 mb-2 text-2xl font-semibold text-secondary">Übersicht der Unternehmen</h4>
                <p class="leading-relaxed text-center text-secondary-700">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam imperdiet est</p>
            </div>
            <div class="flex flex-col items-center md:px-6 lg:px-12">
                <img src="https://picsum.photos/150/150" alt="">
                <h4 class="my-5 mb-2 text-2xl font-semibold text-secondary">Kostenlose Storierung</h4>
                <p class="leading-relaxed text-center text-secondary-700">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam imperdiet est</p>
            </div>
        </div>
    </div>
</div>
<div id="about-us" class="py-12 mt-10 bg-blue-100">
    <div class="container px-6 mx-auto">
        <div class="flex flex-col text-center md:flex-row">
            <div class="md:w-full">
                <h3 class="flex flex-col mb-6 text-4xl font-bold text-secondary">Werde Teil der Community <span class="block w-20 h-1 mt-4 bg-primary"></span></h3>
                <div class="flex my-20">
                    <div class="w-1/2">
                        <img src="https://picsum.photos/150/150" alt="" class="mx-auto">
                        <h4 class="my-5 mb-2 text-2xl font-semibold text-secondary">Als Unternehmen</h4>
                        <p class="px-20 text-xl">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Commodi odit earum, culpa nam labore cupiditate repellendus ea. Neque, veniam molestiae.</p>
                        <a href="#"> Als Unternehmen registrieren</a>
                    </div>
                    <div class="w-1/2">
                        <img src="https://picsum.photos/150/150" alt="" class="mx-auto">
                        <h4 class="my-5 mb-2 text-2xl font-semibold text-secondary">Für Kunden</h4>
                        <p class="px-20 text-xl">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Commodi odit earum, culpa nam labore cupiditate repellendus ea. Neque, veniam molestiae.</p>
                        <a href="#">Als Kunde registrieren</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<footer class="bg-blue-100">
    <div class="container px-6 py-12 mx-auto text-center border-t border-gray-300 text-secondary-500">
        <p>Copyright ©2021 Youmas. All rights reserved. </p>
    </div>
</footer>
@endsection