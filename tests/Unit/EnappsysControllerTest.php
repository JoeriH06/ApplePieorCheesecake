<?php

namespace Tests\Unit\Controllers;

use App\Http\Controllers\EnappsysController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Mockery;
use Tests\Unit\SampleObjectFactory; // Import the factory

class EnappsysControllerTest extends TestCase
{
    // Ducktyping the curl_init function so that I can understand it better.
    // First time using curl_multi_init and curl_multi_exec so this helps to understand it better.
    use RefreshDatabase;
    use WithFaker;

    public function testGetEnappsysData()
    {
        // Use the factory to create a sample object
        $sampleObject = SampleObjectFactory::create();

        // Mocking the curl_init function
        $curlInit = Mockery::mock('alias:curl_init');

        // Expecting setopt method call on curl_init, returning true
        // This is to ensure that the options are set correctly.
        $curlInit->shouldReceive('setopt')->andReturn(true);

        // Expecting exec method call on curl_init, returning sample CSV data.
        // This is to ensure that the data is fetched correctly and in a good format.
        $curlInit->shouldReceive('exec')->andReturn("Date (CET),ACTUAL DA PRICE (EPEX)\n2024-05-30 00:00:00,8.50 EUR/MWh\n");

        // Expecting close method call on curl_init, returning true.
        // This is to ensure that the curl connection is closed.
        $curlInit->shouldReceive('close')->andReturn(true);

        // Creating an instance of the EnappsysController.
        $controller = new EnappsysController();

        // Calling the method to test.
        $response = $controller->getEnappsysData();

        // Asserting that the response is a view, so that it can be rendered correctly.
        $this->assertInstanceOf(\Illuminate\View\View::class, $response);

        // Asserting that the data array is not empty.
        $this->assertNotEmpty($response->getData()['data']);

        // Asserting that the dayType is either 'Apple Pie' or 'Cheesecake' based on the prices from the data provided.
        $this->assertContains($response->getData()['dayType'], ['Apple Pie', 'Cheesecake']);
    }

    protected function tearDown(): void
    {
        // Closing the mockery.
        parent::tearDown();
        Mockery::close();
    }
}
