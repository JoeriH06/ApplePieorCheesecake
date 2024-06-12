<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class EnappsysControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Test the getEnappsysData method.
     *
     * @return void
     */
    public function testGetEnappsysData()
    {
        // Mocking the external API response
        $fakeResponse = "Date (CET),ACTUAL DA PRICE (EPEX)\n" .
                        "2024-05-30 00:00:00,8.50 EUR/MWh\n" .
                        "2024-05-30 01:00:00,12.00 EUR/MWh\n" .
                        "2024-05-30 02:00:00,6.00 EUR/MWh\n" .
                        "2024-05-30 03:00:00,52.00 EUR/MWh\n";

        // Mock the HTTP client
        Http::fake([
            'appqa.enappsys.com/*' => Http::response($fakeResponse, 200)
        ]);

        // Make a GET request to the controller method
        $response = $this->get('/detailedpage');

        // Assert the response status
        $response->assertStatus(200);

        // Assert the view data
        $response->assertViewHas('data');
        $response->assertViewHas('dayType');
        $response->assertViewHas('optimalTimes');
        $response->assertViewHas('limitedTimes');
        $response->assertViewHas('worstTimes');

        // Assert the data content
        $viewData = $response->viewData('data');
        $this->assertNotEmpty($viewData);

        // Assert the day type
        $dayType = $response->viewData('dayType');
        $this->assertContains($dayType, ['Apple Pie', 'Cheesecake']);

        // Assert optimal, limited, and worst times
        $optimalTimes = $response->viewData('optimalTimes');
        $limitedTimes = $response->viewData('limitedTimes');
        $worstTimes = $response->viewData('worstTimes');

        $this->assertCount(count($optimalTimes), $optimalTimes);
        $this->assertNotEmpty($limitedTimes);
        $this->assertNotEmpty($worstTimes);
    }
}
