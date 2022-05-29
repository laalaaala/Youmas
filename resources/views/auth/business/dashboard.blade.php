@extends('layouts.dashboard')

@section('content')
<!--Title-->
<div class="font-sans">
    <a href="#" class="text-base font-bold no-underline md:text-sm text-primary-400 hover:underline">Profile</a>
    <h1 class="pt-6 pb-2 font-sans text-xl text-gray-900 break-normal"></h1>
</div>
<div id="app">
    <business-profile-image-carousel></business-profile-image-carousel>
    <hr class="border-b border-secondary-400">
    <!-- About -->
    <div class="flex flex-row">
        <business-profile-opening-hours> </business-profile-opening-hours>
        <business-profile :user="{{json_encode($user)}}" class="w-3/4" />
    </div>
    <div class="w-full mt-2">
        @if(!$user->stripeAccount)
        <form action="/dashboard/profile/stripe">
            @csrf
            <button class="bg-purple-400 py-1 px-10 font-bold text-white rounded">Connect Stripe Account</button>
        </form>
        @else
        <form action="/dashboard/profile/stripe/deauthorize" method="POST">
            <button class="bg-purple-400 py-1 px-10 font-bold text-white rounded">Disconnect Stripe Account</button>
        </form>
        @endif
    </div>
</div>



@endsection