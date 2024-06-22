@extends('layout.main')

@section('title', 'Detailed Page')

@section('content')
    <h1 class="text-center mt-6 mb-6 text-lg sm:text-xl">EnAppSys Data for {{ date('F j, Y', strtotime($date)) }}</h1>

    <!-- Color Explanation Table -->
    <section class="overflow-x-auto">
        <table id="color-explanation" class="w-full border-collapse border border-gray-300 mb-6 text-sm sm:text-base sm:text-lg">
            <thead>
                <tr>
                    <th class="border border-gray-300 bg-ash-gray px-2 py-2 sm:px-4 sm:py-2">Color</th>
                    <th class="border border-gray-300 bg-ash-gray px-2 py-2 sm:px-4 sm:py-2">Explanation</th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-celadon">
                    <td class="border border-gray-300 px-2 py-2 sm:px-4 sm:py-2">Celadon</td>
                    <td class="border border-gray-300 px-2 py-2 sm:px-4 sm:py-2">Perfect time to bake an apple pie</td>
                </tr>
                <tr class="bg-mint-cream">
                    <td class="border border-gray-300 px-2 py-2 sm:px-4 sm:py-2">Mint Cream</td>
                    <td class="border border-gray-300 px-2 py-2 sm:px-4 sm:py-2">You can make an apple pie, but it is not the optimal time</td>
                </tr>
                <tr class="bg-ash-gray">
                    <td class="border border-gray-300 px-2 py-2 sm:px-4 sm:py-2">Ash Gray</td>
                    <td class="border border-gray-300 px-2 py-2 sm:px-4 sm:py-2">Avoid making an apple pie, try something else!</td>
                </tr>
                <tr class="bg-battleship-gray">
                    <td class="border border-gray-300 px-2 py-2 sm:px-4 sm:py-2">Battleship Gray</td>
                    <td class="border border-gray-300 px-2 py-2 sm:px-4 sm:py-2">Let's make some cheesecakes</td>
                </tr>
                <tr class="bg-feldgrau">
                    <td class="border border-gray-300 px-2 py-2 sm:px-4 sm:py-2">Feldgrau</td>
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
                    <th class="border border-gray-300 bg-ash-gray px-2 py-2 sm:px-4 sm:py-2">Date (CET)</th>
                    <th class="border border-gray-300 bg-ash-gray px-2 py-2 sm:px-4 sm:py-2">ACTUAL DA PRICE (EPEX)</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $row)
                    <tr class="{{ getColorClass($row['ACTUAL DA PRICE (EPEX)']) }}">
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

@php
    function getColorClass($price)
    {
        if ($price <= 20) {
            return 'bg-celadon';
        } elseif ($price <= 40) {
            return 'bg-mint-cream';
        } elseif ($price <= 60) {
            return 'bg-ash-gray';
        } elseif ($price <= 80) {
            return 'bg-battleship-gray';
        } else {
            return 'bg-feldgrau';
        }
    }
@endphp
