<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class EnappsysController extends Controller
{
    public function getEnappsysData()
    {
        $url = 'https://appqa.enappsys.com/datadownload';
        $startDateTime = strtotime('today midnight');
        $endDateTime = strtotime('tomorrow midnight');

        $result = [];
        $error = null;

        // Headers
        $headers = ['Date (CET)', 'ACTUAL DA PRICE (EPEX)'];


        // Make requests in hourly intervals this is to make it easier to handle the data, instead of qh ( 15 minutes )
        for ($start = $startDateTime; $start < $endDateTime; $start += 3600) {
            $end = $start + 3599;
            $queryParams = [
                'code' => 'nl/elec/pricing/daprices/forecast',
                'currency' => 'EUR',
                'minavmax' => 'false',
                'pass' => '193238233229235177178179',
                'res' => 'hourly',
                'tag' => 'csv',
                'timezone' => 'CET',
                'user' => 'jean-paul',
                'start' => date('YmdHis', $start),
                'end' => date('YmdHis', $end)
            ];

            $response = Http::get($url, $queryParams);

            if ($response->successful()) {
                $data = $response->body();
                $lines = explode("\n", trim($data));
                foreach ($lines as $index => $line) {
                    if (!empty($line) && $index > 0) {
                        $columns = str_getcsv($line);
                        if (count($columns) >= count($headers) && is_numeric($columns[1])) {
                            // Clean the price data by removing the trailing text ( e.g. EUR/MWh (EPEX) -> EUR/MWh)
                            $columns[1] = preg_replace('/EUR\/MWh.*$/', 'EUR/MWh', $columns[1]);
                            $result[] = array_combine($headers, array_slice($columns, 0, count($headers)));
                        }
                    }
                }
            }
        }

        // Determine if it's an Apple Pie Day or Cheesecake Day
        $isApplePieDay = false;
        foreach ($result as $row) {
            if (preg_replace('/[^0-9.]/', '', $row['ACTUAL DA PRICE (EPEX)']) < 10) {
                $isApplePieDay = true;
                break;
            }
        }


        $dayType = $isApplePieDay ? 'Apple Pie' : 'Cheesecake';

        $optimalTimes = [];
        $limitedTimes = [];
        $worstTimes = [];

        foreach ($result as $row) {
            $price = preg_replace('/[^0-9.]/', '', $row['ACTUAL DA PRICE (EPEX)']);
            $startDateTime = strtotime($row['Date (CET)']);
            $endDateTime = $startDateTime + 3600; // Assuming each entry represents an hour

            if ($price < 10) {
                if (count($optimalTimes) < 2) {
                    // Format the start and end times
                    $startTime = date('H:i', $startDateTime);
                    $endTime = date('H:i', $endDateTime);
                    $optimalTimes[] = ['start' => $startTime, 'end' => $endTime];
                }
            } elseif ($price >= 10 && $price <= 30) {
                // Similarly, format the start and end times for limitedTimes
                $startTime = date('H:i', $startDateTime);
                $endTime = date('H:i', $endDateTime);
                $limitedTimes[] = ['start' => $startTime, 'end' => $endTime];
            } elseif ($price > 50) {
                // Format the start and end times for worstTimes
                $startTime = date('H:i', $startDateTime);
                $endTime = date('H:i', $endDateTime);
                $worstTimes[] = ['start' => $startTime, 'end' => $endTime];
            }
        }


        return view('detailedpage', [
            'data' => $result,
            'error' => $error,
            'dayType' => $dayType,
            'optimalTimes' => $optimalTimes,
            'limitedTimes' => $limitedTimes,
            'worstTimes' => $worstTimes,
        ]);
    }
}
