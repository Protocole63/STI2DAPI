<?php

use App\Models\Acid;
use App\Repositories\AcidRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AcidRepositoryTest extends TestCase
{
    use MakeAcidTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var AcidRepository
     */
    protected $acidRepo;

    public function setUp()
    {
        parent::setUp();
        $this->acidRepo = App::make(AcidRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateAcid()
    {
        $acid = $this->fakeAcidData();
        $createdAcid = $this->acidRepo->create($acid);
        $createdAcid = $createdAcid->toArray();
        $this->assertArrayHasKey('id', $createdAcid);
        $this->assertNotNull($createdAcid['id'], 'Created Acid must have id specified');
        $this->assertNotNull(Acid::find($createdAcid['id']), 'Acid with given id must be in DB');
        $this->assertModelData($acid, $createdAcid);
    }

    /**
     * @test read
     */
    public function testReadAcid()
    {
        $acid = $this->makeAcid();
        $dbAcid = $this->acidRepo->find($acid->id);
        $dbAcid = $dbAcid->toArray();
        $this->assertModelData($acid->toArray(), $dbAcid);
    }

    /**
     * @test update
     */
    public function testUpdateAcid()
    {
        $acid = $this->makeAcid();
        $fakeAcid = $this->fakeAcidData();
        $updatedAcid = $this->acidRepo->update($fakeAcid, $acid->id);
        $this->assertModelData($fakeAcid, $updatedAcid->toArray());
        $dbAcid = $this->acidRepo->find($acid->id);
        $this->assertModelData($fakeAcid, $dbAcid->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteAcid()
    {
        $acid = $this->makeAcid();
        $resp = $this->acidRepo->delete($acid->id);
        $this->assertTrue($resp);
        $this->assertNull(Acid::find($acid->id), 'Acid should not exist in DB');
    }
}
