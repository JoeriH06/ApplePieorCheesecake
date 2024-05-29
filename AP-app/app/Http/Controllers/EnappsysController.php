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

        // Make requests in hourly intervals
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

            try {
                // Fetch data asynchronously
                $response = $this->fetchAsync($url, $queryParams);

                // Process response data
                $data = $this->processResponse($response);
                $result = array_merge($result, $data);
            } catch (\Exception $e) {
                // Log or handle the error appropriately
                // For now, we'll just ignore the error and continue
                continue;
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
            $date = $row['Date (CET)'];

            if ($price < 10) {
                if (count($optimalTimes) < 2) {
                    $optimalTimes[] = $date;
                }
            } elseif ($price >= 10 && $price <= 50) {
                $limitedTimes[] = $date;
            } elseif ($price > 50) {
                $worstTimes[] = $date;
            }
        }

        return view('detailedpage', [
            'data' => $result,
            'dayType' => $dayType,
            'optimalTimes' => $optimalTimes,
            'limitedTimes' => $limitedTimes,
            'worstTimes' => $worstTimes,
        ]);
    }

    private function fetchAsync($url, $queryParams)
    {
        // Construct the full URL with query parameters
        $fullUrl = $url . '?' . http_build_query($queryParams);

        // Fetch data asynchronously using GuzzleHttp
        $response = Http::get($fullUrl)->throw();

        // Return response body
        return $response->body();
    }

    private function processResponse($response)
    {
        $result = [];
        $lines = explode("\n", trim($response));
        $headers = ['Date (CET)', 'ACTUAL DA PRICE (EPEX)'];

        foreach ($lines as $index => $line) {
            if (!empty($line) && $index > 0) {
                $columns = str_getcsv($line);
                if (count($columns) >= count($headers) && is_numeric($columns[1])) {
                    $columns[1] = preg_replace('/EUR\/MWh.*$/', 'EUR/MWh', $columns[1]);
                    $result[] = array_combine($headers, array_slice($columns, 0, count($headers)));
                }
            }
        }

        return $result;
    }
}
