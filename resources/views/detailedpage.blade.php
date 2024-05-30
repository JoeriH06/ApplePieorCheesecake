@extends('layout.main')

@section('title', 'Detailed Page')

@section('content')
    <h1 class="text-center mt-6 mb-6 text-lg sm:text-xl">EnAppSys Data</h1>

    <!-- Color Explanation Table -->
    <section class="overflow-x-auto">
        <table id="color-explanation" class="w-full border-collapse border border-gray-300 mb-6 text-sm sm:text-base sm:text-lg">
            <thead>
                <tr>
                    <th class="border border-gray-300 bg-gray-200 px-2 py-2 sm:px-4 sm:py-2">Color</th>
                    <th class="border border-gray-300 bg-gray-200 px-2 py-2 sm:px-4 sm:py-2">Explanation</th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-green-400">
                    <td class="border border-gray-300 px-2 py-2 sm:px-4 sm:py-2">Green</td>
                    <td class="border border-gray-300 px-2 py-2 sm:px-4 sm:py-2">Perfect time to bake an apple pie</td>
                </tr>
                <tr class="bg-yellow-300">
                    <td class="border border-gray-300 px-2 py-2 sm:px-4 sm:py-2">Light Orange</td>
                    <td class="border border-gray-300 px-2 py-2 sm:px-4 sm:py-2">You can make an apple pie, but it is not the optimal time</td>
                </tr>
                <tr class="bg-yellow-500">
                    <td class="border border-gray-300 px-2 py-2 sm:px-4 sm:py-2">Orange</td>
                    <td class="border border-gray-300 px-2 py-2 sm:px-4 sm:py-2">Avoid making an apple pie, try something else!</td>
                </tr>
                <tr class="bg-red-600">
                    <td class="border border-gray-300 px-2 py-2 sm:px-4 sm:py-2">Light Red</td>
                    <td class="border border-gray-300 px-2 py-2 sm:px-4 sm:py-2">Let's make some cheesecakes</td>
                </tr>
                <tr class="bg-red-700">
                    <td class="border border-gray-300 px-2 py-2 sm:px-4 sm:py-2">Red</td>
                    <td class="border border-gray-300 px-2 py-2 sm:px-4 sm:py-2">Definitely cheesecake this hour!</td>
                </tr>
            </tbody>
        </table>
    </section>

    <!-- Data Table -->
   <section class="overflow-x-auto">
        <table id="table" class="w-full border-collapse border border-gray-300 text-sm sm:text-base sm:text-lg">
            <thead>
                <tr>
                    <th class="border border-gray-300 bg-gray-200 px-2 py-2 sm:px-4 sm:py-2">Date (CET)</th>
                    <th class="border border-gray-300 bg-gray-200 px-2 py-2 sm:px-4 sm:py-2">ACTUAL DA PRICE (EPEX)</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $row)
                    <tr>
                        <td class="border border-gray-300 px-2 py-2 sm:px-4 sm:py-2">{{ $row['Date (CET)'] }}</td>
                        <td class="border border-gray-300 px-2 py-2 sm:px-4 sm:py-2">{{ $row['ACTUAL DA PRICE (EPEX)'] }} EUR/MWh</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="text-center">No data available</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </section>
@endsection
