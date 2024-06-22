@extends('layout.main')

@section('content')
<div class="relative min-h-screen flex items-center justify-center bg-mint-cream py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white shadow-lg rounded-lg p-10 relative z-10">
        <div class="text-center">
            <h2 class="mt-6 text-3xl font-extrabold text-feldgrau">{{ __('Login') }}</h2>
            <p class="mt-2 text-sm text-gray-600">Curious? Want to see details? Login now!</p>
        </div>

        <form class="mt-8 space-y-6" method="POST" action="{{ route('login') }}">
            @csrf

            <div class="rounded-md shadow-sm -space-y-px">
                <div>
                    <label for="email" class="sr-only">{{ __('Email Address') }}</label>
                    <input id="email" name="email" type="email" autocomplete="email" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-battleship-gray focus:border-battleship-gray focus:z-10 sm:text-sm @error('email') border-red-500 @enderror" placeholder="Email address" value="{{ old('email') }}">
                    @error('email')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="password" class="sr-only">{{ __('Password') }}</label>
                    <input id="password" name="password" type="password" autocomplete="current-password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-battleship-gray focus:border-battleship-gray focus:z-10 sm:text-sm @error('password') border-red-500 @enderror" placeholder="Password">
                    @error('password')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 text-celadon focus:ring-battleship-gray border-gray-300 rounded">
                    <label for="remember_me" class="ml-2 block text-sm text-gray-900">{{ __('Remember Me') }}</label>
                </div>

                @if (Route::has('password.request'))
                    <div class="text-sm">
                        <a href="{{ route('password.request') }}" class="font-medium text-feldgrau hover:text-battleship-gray">{{ __('Forgot Your Password?') }}</a>
                    </div>
                @endif
            </div>

            <div>
                <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-feldgrau hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-feldgrau">
                    {{ __('Login') }}
                </button>
            </div>
        </form>

        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">{{ __('No account?') }} <a href="{{ route('register') }}" class="font-medium text-feldgrau hover:text-battleship-gray">{{ __('Register') }}</a></p>
        </div>
    </div>
</div>
@endsection
