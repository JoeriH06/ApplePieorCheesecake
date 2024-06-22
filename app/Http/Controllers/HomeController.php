<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $date = Carbon::parse($request->input('date', Carbon::today()->format('Y-m-d')));
        $today = Carbon::today();

        // Ensure the date is not more than one day ahead or back
        if ($date->lt($today->copy()->subDay()) || $date->gt($today->copy()->addDay())) {
            $date = $today;
        }

        // Fetch data from EnappsysController or other sources
        $dataService = new EnappsysController();
        $data = $dataService->getEnappsysData($date->format('Y-m-d'));
        \Log::info("Fetched data: ", ['data' => $data]);

        $applePieIndex = count($data['optimalTimes']);

        $previousDate = $date->copy()->subDay();
        $nextDate = $date->copy()->addDay();

        return view('home', [
            'optimalTimes' => $data['optimalTimes'],
            'worstTimes' => $data['worstTimes'],
            'dayType' => $data['dayType'],
            'applePieIndex' => $applePieIndex,
            'date' => $date,
            'previousDate' => $previousDate,
            'nextDate' => $nextDate,
            'today' => $today
        ]);
    }
}
