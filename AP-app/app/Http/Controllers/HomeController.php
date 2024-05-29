<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch data from EnappsysController
        $dataService = new EnappsysController();
        $data = $dataService->getEnappsysData();
        \Log::info("Fetched data: ", ['data' => $data]);

        return view('home', [
            'optimalTimes' => $data['optimalTimes'],
            'limitedTimes' => $data['limitedTimes'],
            'worstTimes' => $data['worstTimes'],
            'dayType' => $data['dayType'],
        ]);
    }
}
