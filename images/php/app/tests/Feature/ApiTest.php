<?php
namespace Tests\Feature;

use App\User;
use Tests\TestCase as TestBase;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ApiTest extends TestBase
{
    public function setUp():void
    {
        parent::setUp();
        $this->createApplication();
    }

    /** @test */
    public function api_responds_with_400_message_to_invalid_request()
    {
        $response = $this->call('GET', '/api/progress');
        $this->assertEquals(400, $response->status());
    }

    /** @test */
    public function api_responds_with_404_message_if_result_is_empty()
    {
        //given we have an non-exisiting user
        $nonExistingUserId = 312312313;
        $response = $this->call('GET', '/api/progress/'.$nonExistingUserId);
        $this->assertEquals(404, $response->status());
    }

    /** @test */
    public function api_responds_with_200_message_if_result_is_not_empty()
    {
        $userId = User::find(1)->id;
        $response = $this->call('GET', '/api/progress/'.$userId);
        $this->assertEquals(200, $response->status());
    }
}
