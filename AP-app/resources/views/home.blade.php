@extends('layout.main')

@section('title', 'Apple or Cheesecake')

@section('content')
<section class="p-4">
    <section class="text-center">
        <h1 class="text-lg sm:text-xl">Today is {{ $dayType }} day!!</h1>
        <img src="{{ asset($dayType === 'Apple Pie' ? '/images/applepie.jpg' : '/images/cheesecake.jpg') }}"
            alt="{{ $dayType }}" class="sm:w-1/3 mx-auto mt-4 mb-4 border-4 border-indigo-300">

        <section class="text-lg sm:text-xl">
            <p class="font-bold">Times to bake an apple pie cheap:</p>
            @if(count($optimalTimes) > 0)
                @for ($i = 0; $i < min(count($optimalTimes), 2); $i++)
                    <p>{{ $optimalTimes[$i] }}</p>
                @endfor
            @else
                <p>There are no optimal times to bake an apple pie today</p>
            @endif

            <p class="font-bold">Some other times you can bake an apple pie less cheap:</p>
            @if(count($limitedTimes) > 0)
                @for ($i = 0; $i < min(count($limitedTimes), 2); $i++)
                    <p>{{ $limitedTimes[$i] }}</p>
                @endfor
            @else
                <p>There are no limited times to bake an apple pie today</p>
            @endif

            <p class="font-bold">Advise to make a cheesecake at these times:</p>
            @if(count($worstTimes) > 0)
                @for ($i = 0; $i < min(count($worstTimes), 2); $i++)
                    <p>{{ $worstTimes[$i] }}</p>
                @endfor
            @else
                <p>There are no bad times to bake an apple pie today</p>
            @endif
        </section>

        <section>
            <p class="sm:text-lg">
                Click <a href="{{ route('detailedpage') }}" class="text-blue-500 hover:text-blue-700">HERE</a> for
                detailed times and prices
            </p>
        </section>
    </section>
</section>
@endsection
