{{--<x-guest-layout>--}}
{{--    <!-- Session Status -->--}}
{{--    <x-auth-session-status class="mb-4" :status="session('status')" />--}}

{{--    <form method="POST" action="{{ route('login') }}">--}}
{{--        @csrf--}}

{{--        <!-- Email Address -->--}}
{{--        <div>--}}
{{--            <x-input-label for="email" :value="__('Email')" />--}}
{{--            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />--}}
{{--            <x-input-error :messages="$errors->get('email')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Password -->--}}
{{--        <div class="mt-4">--}}
{{--            <x-input-label for="password" :value="__('Password')" />--}}

{{--            <x-text-input id="password" class="block mt-1 w-full"--}}
{{--                            type="password"--}}
{{--                            name="password"--}}
{{--                            required autocomplete="current-password" />--}}

{{--            <x-input-error :messages="$errors->get('password')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Remember Me -->--}}
{{--        <div class="block mt-4">--}}
{{--            <label for="remember_me" class="inline-flex items-center">--}}
{{--                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">--}}
{{--                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>--}}
{{--            </label>--}}
{{--        </div>--}}

{{--        <div class="flex items-center justify-end mt-4">--}}
{{--            @if (Route::has('password.request'))--}}
{{--                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">--}}
{{--                    {{ __('Forgot your password?') }}--}}
{{--                </a>--}}
{{--            @endif--}}

{{--            <x-primary-button class="ms-3">--}}
{{--                {{ __('Log in') }}--}}
{{--            </x-primary-button>--}}
{{--        </div>--}}
{{--    </form>--}}
{{--</x-guest-layout>--}}





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iofrm</title>
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}auth-assets/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}auth-assets/assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}auth-assets/assets/css/iofrm-style.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}auth-assets/assets/css/iofrm-theme2.css">
</head>
<body style="background: #ffffff">
<div class="form-body">
    <div class="website-logo">
        <a href="index.html">
{{--            <div>--}}
{{--                <img src="{{asset('/')}}auth-assets/assets/images/studyXchange.png" style="height: 100px; width: auto; margin-left: -30px; margin-top: -55px;" alt="">--}}
{{--            </div>--}}
        </a>
    </div>
    <div class="iofrm-layout">
        <div class="img-holder">
            <div class="bg"></div>
            <div class="info-holder">

            </div>
        </div>
        <div class="form-holder">
            <div class="form-content" style="background: #ffffff">
                <div class="form-items">
                    <div>
                        <img src="{{asset('/')}}auth-assets/assets/images/studyXchange.png" style="height: 100px; width: auto; margin-left: 90px; margin-top: -55px;" alt="">
                    </div>
                    <div class="page-links">
                        <a href="{{route('login')}}" style="color:black; font-size: 20px;" class="active">Login</a>
                    </div>

                    <!-- Login Form -->
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <input class="form-control" style="background-color:white; border: 1px solid #cbcbcb" type="text" name="email" placeholder="E-mail Address" required>
                        <input class="form-control" style="background-color:white; border: 1px solid #cbcbcb" type="password" name="password" placeholder="Password" required>
                        <input type="checkbox" id="chk1"><label for="chk1">Remmeber me</label>
                        <div class="page-links">
                            Don't have an account?
                            <a href="{{route('register')}}" style="color:#0c6dfd; font-weight: bold">Sign Up</a>
                        </div>
                        <div class="form-button">
                            <button id="submit" type="submit" style="background-color: #0c6dfd; color: white;" class="ibtn">Login</button>
                        </div>
                        @if (Route::has('password.request'))
                            <a class="text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 no-underline" href="{{ route('password.request') }}" style="text-decoration: none;">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif

                    </form>
                    <!-- Login Form -->

                    <div class="other-links">
                        <span style="color:black;">Or login with</span><a href="#" style="color:black;">Google</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('/')}}auth-assets/assets/js/jquery.min.js"></script>
<script src="{{asset('/')}}auth-assets/assets/js/popper.min.js"></script>
<script src="{{asset('/')}}auth-assets/assets/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('/')}}auth-assets/assets/js/main.js"></script>
</body>

</html>
