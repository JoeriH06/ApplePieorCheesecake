@extends('layout.main')

@section('title', 'Apple or Cheesecake')

@section('content')
<section class="p-4">
    <section class="text-center">
        <h1 class="text-lg md:text-xl lg:text-2xl">Today is {{ $dayType }} day!!</h1>
        <img src="{{ asset($dayType === 'Apple Pie' ? '/images/applepie.jpg' : '/images/cheesecake.jpg') }}"
            alt="{{ $dayType }}" class="w-full md:w-1/2 lg:w-1/3 mx-auto mt-4 mb-4">

        <section class="text-lg md:text-xl lg:text-2xl">
            <p class="font-bold">Times to bake an apple pie cheap:</p>

            <p class="font-bold">Some times you can bake an apple pie:</p>

            <p class="font-bold">These are the worst baking times for an apple pie today:</p>

        </section>

        <section>
            <p class="md:text-base lg:text-lg">
                Click <a href="{{ route('detailedpage') }}" class="text-blue-500 hover:text-blue-700">HERE</a> for
                detailed times and prices
            </p>
        </section>
    </section>
</section>
@endsection
