@extends('layout.main')

@section('content')
<div class="container mx-auto mt-10">
    <div class="flex justify-center">
        <div class="w-full max-w-md">
            <div class="bg-mint-cream shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <div class="mb-4 text-lg font-bold text-center text-feldgrau">{{ __('Verify Your Email Address') }}</div>

                <div class="mb-4 text-center text-feldgrau">
                    @if (session('resent'))
                        <div class="bg-celadon border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    <p>{{ __('Before proceeding, please check your email for a verification link.') }}</p>
                    <p>{{ __('If you did not receive the email') }},
                        <form class="inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="text-ash-gray hover:underline">{{ __('click here to request another') }}</button>.
                        </form>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
