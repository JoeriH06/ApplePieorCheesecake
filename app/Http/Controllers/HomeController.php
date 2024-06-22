<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // This page is accessible to everyone
        // Fetch data from EnappsysController or other sources
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
