<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HeatApiTest extends TestCase
{
    use MakeHeatTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateHeat()
    {
        $heat = $this->fakeHeatData();
        $this->json('POST', '/api/v1/heats', $heat);

        $this->assertApiResponse($heat);
    }

    /**
     * @test
     */
    public function testReadHeat()
    {
        $heat = $this->makeHeat();
        $this->json('GET', '/api/v1/heats/'.$heat->id);

        $this->assertApiResponse($heat->toArray());
    }

    /**
     * @test
     */
    public function testUpdateHeat()
    {
        $heat = $this->makeHeat();
        $editedHeat = $this->fakeHeatData();

        $this->json('PUT', '/api/v1/heats/'.$heat->id, $editedHeat);

        $this->assertApiResponse($editedHeat);
    }

    /**
     * @test
     */
    public function testDeleteHeat()
    {
        $heat = $this->makeHeat();
        $this->json('DELETE', '/api/v1/heats/'.$heat->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/heats/'.$heat->id);

        $this->assertResponseStatus(404);
    }
}
