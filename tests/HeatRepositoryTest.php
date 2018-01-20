<?php

use App\Models\Heat;
use App\Repositories\HeatRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HeatRepositoryTest extends TestCase
{
    use MakeHeatTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var HeatRepository
     */
    protected $heatRepo;

    public function setUp()
    {
        parent::setUp();
        $this->heatRepo = App::make(HeatRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateHeat()
    {
        $heat = $this->fakeHeatData();
        $createdHeat = $this->heatRepo->create($heat);
        $createdHeat = $createdHeat->toArray();
        $this->assertArrayHasKey('id', $createdHeat);
        $this->assertNotNull($createdHeat['id'], 'Created Heat must have id specified');
        $this->assertNotNull(Heat::find($createdHeat['id']), 'Heat with given id must be in DB');
        $this->assertModelData($heat, $createdHeat);
    }

    /**
     * @test read
     */
    public function testReadHeat()
    {
        $heat = $this->makeHeat();
        $dbHeat = $this->heatRepo->find($heat->id);
        $dbHeat = $dbHeat->toArray();
        $this->assertModelData($heat->toArray(), $dbHeat);
    }

    /**
     * @test update
     */
    public function testUpdateHeat()
    {
        $heat = $this->makeHeat();
        $fakeHeat = $this->fakeHeatData();
        $updatedHeat = $this->heatRepo->update($fakeHeat, $heat->id);
        $this->assertModelData($fakeHeat, $updatedHeat->toArray());
        $dbHeat = $this->heatRepo->find($heat->id);
        $this->assertModelData($fakeHeat, $dbHeat->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteHeat()
    {
        $heat = $this->makeHeat();
        $resp = $this->heatRepo->delete($heat->id);
        $this->assertTrue($resp);
        $this->assertNull(Heat::find($heat->id), 'Heat should not exist in DB');
    }
}
