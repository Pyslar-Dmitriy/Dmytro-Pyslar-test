<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Testing\TestResponse;
use Tests\TestCase;
use function PHPUnit\Framework\assertCount;

class UsersControllerTest extends TestCase
{
    private TestResponse $response;
    private array $users;

    protected function setUp(): void
    {
        parent::setUp();
        $this->response = $this->get('/api/users');

        $xml = simplexml_load_string($this->response->content());
        $json = json_encode($xml);
        $this->users = json_decode($json, associative: true)['user'];
    }

    public function test_endpointAvailability(): void
    {
        $this->response->assertStatus(200);
    }

    public function test_hasCorrectHeader(): void
    {
        $this->response->assertHeader('Content-Type', 'application/xml');
    }

    public function test_hasCorrectAmountOfUsersByDefault(): void
    {
        assertCount(10, $this->users);
    }

    public function test_hasCorrectAmountOfUsersByParameter(): void
    {
        $limit = 23;

        $this->response = $this->get("/api/users?limit=$limit");

        $xml = simplexml_load_string($this->response->content());
        $json = json_encode($xml);
        $users = json_decode($json, associative: true)['user'];

        assertCount($limit, $users);
    }

    public function test_hasCorrectStructure(): void
    {
        foreach ($this->users as $user) {
            self::assertArrayHasKey('fullName', $user);
            self::assertArrayHasKey('phone', $user);
            self::assertArrayHasKey('email', $user);
            self::assertArrayHasKey('country', $user);
        }
    }
}
