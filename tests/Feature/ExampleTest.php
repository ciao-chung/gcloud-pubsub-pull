<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * @group test
     */
    public function testBasicTest()
    {
        // arrange
        $params = [
            'foobar' => 'foobar',
        ];

        // act
        $response = $this->json('POST', '/api/receive-notification', $params);

        // assert
        $response->assertStatus(200);
    }
}
