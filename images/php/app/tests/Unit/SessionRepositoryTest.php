<?php
namespace Tests\Unit;

use App\User;
use App\Session;
use Tests\TestCase as TestBase;
use App\Repositories\SessionRepository;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class SessionRepositoryTest extends TestBase
{
    protected $repository;

    public function setUp():void
    {
        parent::setUp();
        $this->createApplication();
        $this->initiateRepository();
    }

    /** @test */
    public function repository_returns_progress_result_as_array()
    {
        $userId = User::find(1)->id;
        $this->assertIsArray($this->repository->getProgressHistory($userId));
    }

    /** @test */
    public function progress_rsult_array_cointains_history()
    {
            $userId = User::find(1)->id;
            $this->assertArrayHasKey('history', $this->repository->getProgressHistory($userId));
    }

    /** @test */
    public function history_values_contain_id_date_score_keys()
    {
            $userId = User::find(1)->id;
            $this->assertTrue(property_exists($this->repository->getProgressHistory($userId)['history'][0], 'id'));
            $this->assertTrue(property_exists($this->repository->getProgressHistory($userId)['history'][0], 'date'));
            $this->assertTrue(property_exists($this->repository->getProgressHistory($userId)['history'][0], 'score'));
    }

    /** @test */
    public function repository_throws_exception_if_id_argument_is_empty()
    {
            $this->expectException(\InvalidArgumentException::class);

            $this->repository->getProgressHistory();
    }

    /** @test */
    public function repository_returns_categories_for_latest_session_of_a_user()
    {
            // given we have a latest session for a user
            $lastSession = Session::latest()->first();
            $userId =  $lastSession->user_id;

            // repository returns same session for that user
            $result = $this->repository->getLastSessionCategories($userId);
            $this->assertEquals($lastSession->id, $result['session_id']);
    }

    /** @test */
    public function repository_returns_categories_as_an_array_consists_of_session_id_and_array_of_categories()
    {
            $userId = User::find(1)->id;

            $result = $this->repository->getLastSessionCategories($userId);
            $this->assertIsArray($result);

            //includes session id
            $this->assertArrayHasKey('session_id', $result);
            //includes categores
            $this->assertArrayHasKey('categories', $result);
            //and categores is array
            $this->assertIsArray($result['categories']);
    }

    /** @test */
    public function it_returns_emoty_if_no_result_is_found()
    {
            $noExistingUserId = 123123123123123;

            $this->assertEmpty($this->repository->getLastSessionCategories($noExistingUserId));
    }

    protected function initiateRepository()
    {
        $this->repository = new SessionRepository;
    }
}
