<?php
use Illuminate\Support\Facades\View;
use Tests\TestCase;

class EnappsysControllerTest extends TestCase
{
    public function testDetailedPageView()
    {
        // Call the controller action
        $response = $this->get(route('detailedpage'));

        // Assert the response is successful
        $response->assertStatus(200);

        // Assert the view is returned
        $response->assertViewIs('detailedpage');

        // Assert the title is set correctly
        $response->assertSee('Detailed Page');

        // Assert the header is displayed
        $response->assertSee('EnAppSys Data');

        // Assert the optimal times are displayed
        $response->assertSee('Times to bake an apple pie cheap:');
        $response->assertSee('There are no optimal times');

        // Assert the limited times are displayed
        $response->assertSee('Some other times you can bake an apple pie less cheap:');
        $response->assertSee('There are no limited times');

        // Assert the worst times are displayed
        $response->assertSee('Advise to make a cheesecake at these times:');
        $response->assertSee('There are no bad times');

        // Assert the link to the home page is present
        $response->assertSee('Home');
        $response->assertSee(route('home'));
    }
}
