<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AcidApiTest extends TestCase
{
    use MakeAcidTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateAcid()
    {
        $acid = $this->fakeAcidData();
        $this->json('POST', '/api/v1/acids', $acid);

        $this->assertApiResponse($acid);
    }

    /**
     * @test
     */
    public function testReadAcid()
    {
        $acid = $this->makeAcid();
        $this->json('GET', '/api/v1/acids/'.$acid->id);

        $this->assertApiResponse($acid->toArray());
    }

    /**
     * @test
     */
    public function testUpdateAcid()
    {
        $acid = $this->makeAcid();
        $editedAcid = $this->fakeAcidData();

        $this->json('PUT', '/api/v1/acids/'.$acid->id, $editedAcid);

        $this->assertApiResponse($editedAcid);
    }

    /**
     * @test
     */
    public function testDeleteAcid()
    {
        $acid = $this->makeAcid();
        $this->json('DELETE', '/api/v1/acids/'.$acid->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/acids/'.$acid->id);

        $this->assertResponseStatus(404);
    }
}
