<?php

namespace Tests\Unit;

use Tests\TestCase;

class GetUsersTest extends TestCase
{
    public function testGetUsersRouteWithLimit()
    {
        //Here I would still make a fake client to get random users, returning static data and compare the structures
        // of the received response from that client. And a couple of test cases for bugs.
        // But that would require more time to run the test case.
        $limit = 3;
        $response = $this->get("/api/get-users?limit={$limit}");

        $response->assertStatus(200);

        $response->assertHeader('Content-Type', 'application/xml');
    }
}
