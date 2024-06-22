<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->input('date', Carbon::today()->format('Y-m-d'));

        // Fetch data from EnappsysController or other sources
        $dataService = new EnappsysController();
        $data = $dataService->getEnappsysData($date);
        \Log::info("Fetched data: ", ['data' => $data]);

        $applePieIndex = count($data['optimalTimes']);

        // Fetch Apple Pie Index for the whole month
        $currentMonth = Carbon::parse($date)->format('Y-m');
        $cacheKey = 'apple_pie_index_' . $currentMonth;

        $totalApplePieIndexForMonth = Cache::get($cacheKey, 0);

        return view('home', [
            'optimalTimes' => $data['optimalTimes'],
            'worstTimes' => $data['worstTimes'],
            'dayType' => $data['dayType'],
            'applePieIndex' => $applePieIndex,
            'totalApplePieIndexForMonth' => $totalApplePieIndexForMonth,
            'date' => $date
        ]);
    }
}
