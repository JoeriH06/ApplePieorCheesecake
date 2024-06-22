@extends('layout.main')

@section('title', 'Detailed Page')

@section('content')
<h1 class="text-center mt-6 mb-6 text-lg sm:text-xl">EnAppSys Data for {{ date('F j, Y', strtotime($date)) }}</h1>

<!-- Color Explanation Table -->
<section class="overflow-x-auto">
    <table id="color-explanation"
        class="w-full border-collapse border border-gray-300 mb-6 text-xs sm:text-base md:text-lg">
        <thead>
            <tr>
                <th class="border border-gray-300 bg-terra-cotta px-1 py-1 sm:px-4 sm:py-2">Color</th>
                <th class="border border-gray-300 bg-terra-cotta px-1 py-1 sm:px-4 sm:py-2">Explanation</th>
            </tr>
        </thead>
        <tbody>
            <tr class="bg-light-sage">
                <td class="border border-gray-300 px-1 py-1 sm:px-4 sm:py-2">Light Sage</td>
                <td class="border border-gray-300 px-1 py-1 sm:px-4 sm:py-2">Perfect time to bake an apple pie</td>
            </tr>
            <tr class="bg-medium-sage">
                <td class="border border-gray-300 px-1 py-1 sm:px-4 sm:py-2">Medium Sage</td>
                <td class="border border-gray-300 px-1 py-1 sm:px-4 sm:py-2">You can make an apple pie, but it is not
                    the optimal time</td>
            </tr>
            <tr class="bg-terracotta">
                <td class="border border-gray-300 px-1 py-1 sm:px-4 sm:py-2">Terracotta</td>
                <td class="border border-gray-300 px-1 py-1 sm:px-4 sm:py-2">Avoid making an apple pie, try something
                    else!</td>
            </tr>
            <tr class="bg-burnt-sienna">
                <td class="border border-gray-300 px-1 py-1 sm:px-4 sm:py-2">Burnt Sienna</td>
                <td class="border border-gray-300 px-1 py-1 sm:px-4 sm:py-2">Let's make some cheesecakes</td>
            </tr>
            <tr class="bg-dark-terracotta">
                <td class="border border-gray-300 px-1 py-1 sm:px-4 sm:py-2">Dark Terracotta</td>
                <td class="border border-gray-300 px-1 py-1 sm:px-4 sm:py-2">Definitely cheesecake this hour!</td>
            </tr>
        </tbody>
    </table>
</section>

<!-- Data Table -->
<section class="overflow-x-auto">
    <table id="table" class="w-full border-collapse border border-gray-300 text-xs sm:text-base md:text-lg">
        <thead>
            <tr>
                <th class="border border-gray-300 bg-terra-cotta px-1 py-1 sm:px-4 sm:py-2">Date (CET)</th>
                <th class="border border-gray-300 bg-terra-cotta px-1 py-1 sm:px-4 sm:py-2">ACTUAL DA PRICE (EPEX)</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $row)
                <tr class="{{ getColorClass($row['ACTUAL DA PRICE (EPEX)']) }}">
                    <td class="border border-gray-300 px-1 py-1 sm:px-4 sm:py-2">{{ $row['Date (CET)'] }}</td>
                    <td class="border border-gray-300 px-1 py-1 sm:px-4 sm:py-2">{{ $row['ACTUAL DA PRICE (EPEX)'] }}
                        EUR/MWh</td>
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
            return 'bg-light-sage';
        } elseif ($price <= 40) {
            return 'bg-medium-sage';
        } elseif ($price <= 60) {
            return ' bg-terracotta';
        } elseif ($price <= 80) {
            return 'bg-dark-terracotta';
        } else {
            return 'bg-burnt-sienna';
        }
    }
@endphp
