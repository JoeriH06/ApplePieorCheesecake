@extends('layout.main')

@section('title', 'Apple or Cheesecake')

@section('content')
<section class="p-4">
    <!-- Hero Section -->
    <section class="bg-cover bg-center h-96 flex items-center justify-center bg-battleship-gray">
        <div class="text-center text-white">
            <img src="{{ asset('images/appleicons.png') }}" alt="Apple Pie or Cheesecake" class="mx-auto mb-4 w-24 h-24">
            <h1 class="text-4xl font-bold">Apple Pie or Cheesecake</h1>
            <p class="text-lg mt-4">Discover the best times to bake your favorite desserts</p>
        </div>
    </section>

    <!-- Today's Type Section -->
    <section class="bg-ash-gray p-8 my-8 rounded-lg shadow-md flex items-center">
        <div class="w-2/3">
            <img src="{{ asset($dayType === 'Apple Pie' ? '/images/applepie.jpg' : '/images/cheesecake.jpg') }}" alt="{{ $dayType }}" class="w-1/2 mt-4 mb-4 rounded-lg shadow-lg">
        </div>
        <div class="w-1/3 pl-8">
            <h2 class="text-3xl font-bold text-feldgrau">Today is {{ $dayType }} day!!</h2>
            <p class="text-lg font-semibold text-feldgrau">
                @if($dayType === 'Apple Pie')
                    Fun Fact: Apple pie is an unofficial symbol of the United States and one of its signature comfort foods.
                @else
                    Fun Fact: Cheesecake dates back to ancient Greece and was even served to athletes during the first Olympic Games.
                @endif
            </p>
        </div>
    </section>

    <!-- Navigation Buttons -->
    <div class="flex justify-between items-center my-4">
        @if ($date->notEqualTo($today->copy()->subDay()))
            <a href="{{ route('home', ['date' => $previousDate->format('Y-m-d')]) }}" class="text-battleship-gray hover:text-ash-gray px-4 py-2 bg-white border border-feldgrau shadow-sm rounded-lg transition duration-300 ease-in-out transform hover:-translate-y-1">&larr; Yesterday ({{ $previousDate->format('F j, Y') }})</a>
        @else
            <span class="text-gray-500 px-4 py-2">&larr; Yesterday ({{ $previousDate->format('F j, Y') }})</span>
        @endif
        <span class="text-lg font-bold">{{ $date->format('F j, Y') }}</span>
        @if ($date->notEqualTo($today->copy()->addDay()))
            <a href="{{ route('home', ['date' => $nextDate->format('Y-m-d')]) }}" class="text-battleship-gray hover:text-ash-gray px-4 py-2 bg-white border border-feldgrau shadow-sm rounded-lg transition duration-300 ease-in-out transform hover:-translate-y-1">Tomorrow ({{ $nextDate->format('F j, Y') }}) &rarr;</a>
        @else
            <span class="text-gray-500 px-4 py-2">Tomorrow ({{ $nextDate->format('F j, Y') }}) &rarr;</span>
        @endif
    </div>

    <!-- Times to Bake Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h3 class="font-bold text-battleship-gray">Times to bake an apple pie cheap:</h3>
            @if(count($optimalTimes) > 0)
                <table class="table-auto w-full mx-auto mt-2">
                    <tbody>
                        @foreach (array_chunk($optimalTimes, 2) as $chunk)
                            <tr>
                                @foreach ($chunk as $time)
                                    <td class="border px-4 py-2 text-gray-700">{{ $time }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>There are no optimal times to bake an apple pie today</p>
            @endif

            <h3 class="font-bold text-battleship-gray mt-6">Advise to make a cheesecake at these times:</h3>
            @if(count($worstTimes) > 0)
                <table class="table-auto w-full mx-auto mt-2">
                    <tbody>
                        @foreach (array_chunk($worstTimes, 2) as $chunk)
                            <tr>
                                @foreach ($chunk as $time)
                                    <td class="border px-4 py-2 text-gray-700">{{ $time }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>There are no bad times to bake an apple pie today</p>
            @endif
        </div>

        <div class="bg-white shadow-md rounded-lg p-6">
            <h3 class="font-bold text-battleship-gray">Apple Pie Index (when the price is lower than 10):</h3>
            <table class="table-auto w-full mx-auto mt-2">
                <tbody>
                    <tr>
                        <td class="border px-4 py-2 text-gray-700">Total Optimal Times Today:</td>
                        <td class="border px-4 py-2 text-gray-700">{{ $applePieIndex }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Call to Action Section -->
    <section class="text-center mt-8">
        <p class="sm:text-lg">
            Click <a href="{{ route('detailedpage', ['date' => $date->format('Y-m-d')]) }}" class="text-battleship-gray hover:text-ash-gray">HERE</a> for detailed times and prices
        </p>
    </section>
</section>
@endsection
