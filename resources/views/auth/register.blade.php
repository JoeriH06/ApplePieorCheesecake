@extends('layout.main')

@section('content')
<div class="relative min-h-screen flex items-center justify-center bg-mint-cream py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white shadow-lg rounded-lg p-10 relative z-10">
        <div class="text-center">
            <h2 class="mt-6 text-3xl font-extrabold text-feldgrau">{{ __('Register') }}</h2>
            <p class="mt-2 text-sm text-gray-600">Join us now to get access to more details!</p>
        </div>

        <form class="mt-8 space-y-6" method="POST" action="{{ route('register') }}">
            @csrf

            <div class="rounded-md shadow-sm -space-y-px">
                <div>
                    <label for="name" class="sr-only">{{ __('Name') }}</label>
                    <input id="name" name="name" type="text" autocomplete="name" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm @error('name') border-red-500 @enderror" placeholder="Name" value="{{ old('name') }}">
                    @error('name')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="email" class="sr-only">{{ __('Email Address') }}</label>
                    <input id="email" name="email" type="email" autocomplete="email" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm @error('email') border-red-500 @enderror" placeholder="Email address" value="{{ old('email') }}">
                    @error('email')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="password" class="sr-only">{{ __('Password') }}</label>
                    <input id="password" name="password" type="password" autocomplete="new-password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm @error('password') border-red-500 @enderror" placeholder="Password">
                    @error('password')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="password-confirm" class="sr-only">{{ __('Confirm Password') }}</label>
                    <input id="password-confirm" name="password_confirmation" type="password" autocomplete="new-password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" placeholder="Confirm Password">
                </div>
            </div>

            <div>
                <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    {{ __('Register') }}
                </button>
            </div>
        </form>

        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">{{ __('Already have an account?') }} <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-500">{{ __('Login') }}</a></p>
        </div>
    </div>
</div>
@endsection
