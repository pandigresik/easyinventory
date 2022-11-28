<?php namespace Tests\Repositories;

use App\Models\Inventory\Uom;
use App\Repositories\Inventory\UomRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class UomRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var UomRepository
     */
    protected $uomRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->uomRepo = \App::make(UomRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_uom()
    {
        $uom = Uom::factory()->make()->toArray();

        $createdUom = $this->uomRepo->create($uom);

        $createdUom = $createdUom->toArray();
        $this->assertArrayHasKey('id', $createdUom);
        $this->assertNotNull($createdUom['id'], 'Created Uom must have id specified');
        $this->assertNotNull(Uom::find($createdUom['id']), 'Uom with given id must be in DB');
        $this->assertModelData($uom, $createdUom);
    }

    /**
     * @test read
     */
    public function test_read_uom()
    {
        $uom = Uom::factory()->create();

        $dbUom = $this->uomRepo->find($uom->id);

        $dbUom = $dbUom->toArray();
        $this->assertModelData($uom->toArray(), $dbUom);
    }

    /**
     * @test update
     */
    public function test_update_uom()
    {
        $uom = Uom::factory()->create();
        $fakeUom = Uom::factory()->make()->toArray();

        $updatedUom = $this->uomRepo->update($fakeUom, $uom->id);

        $this->assertModelData($fakeUom, $updatedUom->toArray());
        $dbUom = $this->uomRepo->find($uom->id);
        $this->assertModelData($fakeUom, $dbUom->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_uom()
    {
        $uom = Uom::factory()->create();

        $resp = $this->uomRepo->delete($uom->id);

        $this->assertTrue($resp);
        $this->assertNull(Uom::find($uom->id), 'Uom should not exist in DB');
    }
}
