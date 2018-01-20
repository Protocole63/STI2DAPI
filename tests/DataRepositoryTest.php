<?php

use App\Models\Data;
use App\Repositories\DataRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DataRepositoryTest extends TestCase
{
    use MakeDataTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var DataRepository
     */
    protected $dataRepo;

    public function setUp()
    {
        parent::setUp();
        $this->dataRepo = App::make(DataRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateData()
    {
        $data = $this->fakeDataData();
        $createdData = $this->dataRepo->create($data);
        $createdData = $createdData->toArray();
        $this->assertArrayHasKey('id', $createdData);
        $this->assertNotNull($createdData['id'], 'Created Data must have id specified');
        $this->assertNotNull(Data::find($createdData['id']), 'Data with given id must be in DB');
        $this->assertModelData($data, $createdData);
    }

    /**
     * @test read
     */
    public function testReadData()
    {
        $data = $this->makeData();
        $dbData = $this->dataRepo->find($data->id);
        $dbData = $dbData->toArray();
        $this->assertModelData($data->toArray(), $dbData);
    }

    /**
     * @test update
     */
    public function testUpdateData()
    {
        $data = $this->makeData();
        $fakeData = $this->fakeDataData();
        $updatedData = $this->dataRepo->update($fakeData, $data->id);
        $this->assertModelData($fakeData, $updatedData->toArray());
        $dbData = $this->dataRepo->find($data->id);
        $this->assertModelData($fakeData, $dbData->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteData()
    {
        $data = $this->makeData();
        $resp = $this->dataRepo->delete($data->id);
        $this->assertTrue($resp);
        $this->assertNull(Data::find($data->id), 'Data should not exist in DB');
    }
}
