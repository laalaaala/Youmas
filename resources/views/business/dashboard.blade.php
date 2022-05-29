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
    <div class="flex flex-col xl:flex-row">
        <business-profile-opening-hours> </business-profile-opening-hours>
        <business-profile :user="{{json_encode($user)}}" class="xl:w-3/4" />
    </div>
    <div class="w-full mt-2">
        @if(!$user->stripeAccount && $user->subscription->plan_name == 'Golden')
        <form action="/dashboard/profile/stripe">
            @csrf
            <button class="px-10 py-1 font-bold text-white bg-purple-400 rounded">Connect Stripe Account</button>
        </form>
        @elseif ($user->stripeAccount && $user->subscription->plan_name == 'Golden')
        <form action="/dashboard/profile/stripe/deauthorize" method="POST">
            <button class="px-10 py-1 font-bold text-white bg-purple-400 rounded">Disconnect Stripe Account</button>
        </form>
        @endif
    </div>
</div>



@endsection