<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DataApiTest extends TestCase
{
    use MakeDataTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateData()
    {
        $data = $this->fakeDataData();
        $this->json('POST', '/api/v1/data', $data);

        $this->assertApiResponse($data);
    }

    /**
     * @test
     */
    public function testReadData()
    {
        $data = $this->makeData();
        $this->json('GET', '/api/v1/data/'.$data->id);

        $this->assertApiResponse($data->toArray());
    }

    /**
     * @test
     */
    public function testUpdateData()
    {
        $data = $this->makeData();
        $editedData = $this->fakeDataData();

        $this->json('PUT', '/api/v1/data/'.$data->id, $editedData);

        $this->assertApiResponse($editedData);
    }

    /**
     * @test
     */
    public function testDeleteData()
    {
        $data = $this->makeData();
        $this->json('DELETE', '/api/v1/data/'.$data->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/data/'.$data->id);

        $this->assertResponseStatus(404);
    }
}
