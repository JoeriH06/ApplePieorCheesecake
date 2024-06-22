<?php

namespace App\Http\Controllers;
// <!-- My knowledge about multi and curl handlers: https://www-php-net.translate.goog/manual/en/function.curl-multi-add-handle.php?_x_tr_sl=en&_x_tr_tl=nl&_x_tr_hl=nl&_x_tr_pto=sc -->
// <!-- also found this youtube video: https://www.youtube.com/watch?v=ZIsdbVOQJNc -->
// - interacting with an external API usingGET, POST, PUT, PATCH, DELETE requests
// - sending post data with the request
// - setting HTTP headers
// - decoding and encoding JSON data
// - writing the response to a file

// <!-- used duck method in my code for myself so understand it better, but also for the people who are going to read this code -->


class EnappsysController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        return view('dashboard');  // Accessible only to authenticated users
    }

    public function profile()
    {
        return view('profile');  // Accessible only to authenticated users
    }
    public function getEnappsysData()
    {
        $url = 'https://appqa.enappsys.com/datadownload';
        $startDateTime = strtotime('today midnight');
        $endDateTime = strtotime('tomorrow midnight');

        // Initialize multi-handle
        $multiHandle = curl_multi_init();
        $curlHandles = [];

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

            // Initialize curl handle
            $curlHandle = curl_init();
            curl_setopt($curlHandle, CURLOPT_URL, $url . '?' . http_build_query($queryParams));
            curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true); // settings a response instead of outputting it

            // Add handle to multi-handle
            curl_multi_add_handle($multiHandle, $curlHandle);

            $curlHandles[] = $curlHandle;
        }

        // Execute all requests concurrently
        $running = null;
        do {
            curl_multi_exec($multiHandle, $running);
        } while ($running > 0);

        // Process responses
        $result = [];
        foreach ($curlHandles as $curlHandle) {
            // Get response content
            $response = curl_multi_getcontent($curlHandle);

            // Process response data
            $data = $this->processResponse($response);
            $result = array_merge($result, $data);

            // Remove handle from multi-handle
            curl_multi_remove_handle($multiHandle, $curlHandle);

            // Close the curl handle
            curl_close($curlHandle);
        }

        // Close multi-handle
        curl_multi_close($multiHandle);

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

    /**
     * Process the response data.
     *
     * @param string $response
     * @return array
     */
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
