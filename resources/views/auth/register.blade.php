{{--<x-guest-layout>--}}
{{--    <form method="POST" action="{{ route('register') }}">--}}
{{--        @csrf--}}

{{--        <!-- Name -->--}}
{{--        <div>--}}
{{--            <x-input-label for="name" :value="__('Name')" />--}}
{{--            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />--}}
{{--            <x-input-error :messages="$errors->get('name')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Email Address -->--}}
{{--        <div class="mt-4">--}}
{{--            <x-input-label for="email" :value="__('Email')" />--}}
{{--            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />--}}
{{--            <x-input-error :messages="$errors->get('email')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Password -->--}}
{{--        <div class="mt-4">--}}
{{--            <x-input-label for="password" :value="__('Password')" />--}}

{{--            <x-text-input id="password" class="block mt-1 w-full"--}}
{{--                            type="password"--}}
{{--                            name="password"--}}
{{--                            required autocomplete="new-password" />--}}

{{--            <x-input-error :messages="$errors->get('password')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Confirm Password -->--}}
{{--        <div class="mt-4">--}}
{{--            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />--}}

{{--            <x-text-input id="password_confirmation" class="block mt-1 w-full"--}}
{{--                            type="password"--}}
{{--                            name="password_confirmation" required autocomplete="new-password" />--}}

{{--            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <div class="flex items-center justify-end mt-4">--}}
{{--            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">--}}
{{--                {{ __('Already registered?') }}--}}
{{--            </a>--}}

{{--            <x-primary-button class="ms-4">--}}
{{--                {{ __('Register') }}--}}
{{--            </x-primary-button>--}}
{{--        </div>--}}
{{--    </form>--}}
{{--</x-guest-layout>--}}





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}auth-assets/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}auth-assets/assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}auth-assets/assets/css/iofrm-style.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}auth-assets/assets/css/iofrm-theme2.css">
</head>
<body style="background: #ffffff">
<div class="form-body">
    <div class="website-logo">
        <a href="index.html">
            <div>
{{--                <img src="{{asset('/')}}auth-assets/assets/images/matrix-outsider.png" style="height: 50px; width: auto; margin-left: -30px; margin-top: -20px;" alt="">--}}
            </div>
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
{{--                        <a href="{{route('login')}}">Login</a>--}}
                        <a href="{{route('register')}}" style="color:black; font-size: 20px;" class="active">Register</a>
                    </div>
                    <!-- Signup Form -->
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <input class="form-control" style="background-color:white; border: 1px solid #cbcbcb" type="text" name="name" placeholder="Full Name" required>
                        <input class="form-control" style="background-color:white; border: 1px solid #cbcbcb" type="email" name="email" placeholder="E-mail Address" required>
                        <input class="form-control" style="background-color:white; border: 1px solid #cbcbcb" type="password" name="password" placeholder="Password" required>
                        <input class="form-control" style="background-color:white; border: 1px solid #cbcbcb" type="password" name="password_confirmation" placeholder="Password Confirmation" required>
                        <div class="form-button">
                            <button id="submit" style="background-color: #0c6dfd; color: white;" type="submit" class="ibtn">Sing Up</button>
                        </div>
                    </form>
                    <!-- Signup Form -->
                    <div class="other-links">
                        <span style="color:black;">Or register with</span>
                        <a href="#" style="color:black; text-decoration: none">Facebook</a>
                        <a href="#" style="color:black; text-decoration: none">Google</a>
                        <a href="#" style="color:black; text-decoration: none">Linkedin</a>
                    </div>
                    <br>
                    <div class="page-links">
                        Already a member?
                        <a href="{{route('login')}}" style="color:#0c6dfd; font-weight: bold">Login</a>
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
