<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\YourModel; // Import the model if needed
use App\Models\AnotherModel; // Import additional models if needed

class EnappsysControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testForDaytypes()
    {
        // Mock the HTTP responses
        $url = 'https://appqa.enappsys.com/datadownload';

        $responses = [
            Http::response("Date (CET),ACTUAL DA PRICE (EPEX)\n2023-05-27 00:00:00,5 EUR/MWh", 200),
            Http::response("Date (CET),ACTUAL DA PRICE (EPEX)\n2023-05-27 01:00:00,20 EUR/MWh", 200),
            Http::response("Date (CET),ACTUAL DA PRICE (EPEX)\n2023-05-27 02:00:00,35 EUR/MWh", 200),
            Http::response("Date (CET),ACTUAL DA PRICE (EPEX)\n2023-05-27 03:00:00,55 EUR/MWh", 200),
        ];

        Http::fake([
            $url => Http::sequence($responses)
        ]);

        // Perform the HTTP request
        $response = $this->get('/detailedpage');

        // Assert that the response is successful
        $response->assertStatus(200);

        // Assert that the 'dayType' is either 'Cheesecake' or 'Apple Pie'
        $response->assertViewHas('dayType', function ($dayType) {
            return in_array($dayType, ['Cheesecake', 'Apple Pie']);
        });

        // Assert that the 'worstTimes' array contains the expected value
        $response->assertViewHas('worstTimes', function ($worstTimes) {
            return in_array('[28/05/2024 03:00]', $worstTimes);
        });


    }
}
