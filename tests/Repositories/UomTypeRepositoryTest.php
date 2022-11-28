<?php namespace Tests\Repositories;

use App\Models\Inventory\UomType;
use App\Repositories\Inventory\UomTypeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class UomTypeRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var UomTypeRepository
     */
    protected $uomTypeRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->uomTypeRepo = \App::make(UomTypeRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_uom_type()
    {
        $uomType = UomType::factory()->make()->toArray();

        $createdUomType = $this->uomTypeRepo->create($uomType);

        $createdUomType = $createdUomType->toArray();
        $this->assertArrayHasKey('id', $createdUomType);
        $this->assertNotNull($createdUomType['id'], 'Created UomType must have id specified');
        $this->assertNotNull(UomType::find($createdUomType['id']), 'UomType with given id must be in DB');
        $this->assertModelData($uomType, $createdUomType);
    }

    /**
     * @test read
     */
    public function test_read_uom_type()
    {
        $uomType = UomType::factory()->create();

        $dbUomType = $this->uomTypeRepo->find($uomType->id);

        $dbUomType = $dbUomType->toArray();
        $this->assertModelData($uomType->toArray(), $dbUomType);
    }

    /**
     * @test update
     */
    public function test_update_uom_type()
    {
        $uomType = UomType::factory()->create();
        $fakeUomType = UomType::factory()->make()->toArray();

        $updatedUomType = $this->uomTypeRepo->update($fakeUomType, $uomType->id);

        $this->assertModelData($fakeUomType, $updatedUomType->toArray());
        $dbUomType = $this->uomTypeRepo->find($uomType->id);
        $this->assertModelData($fakeUomType, $dbUomType->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_uom_type()
    {
        $uomType = UomType::factory()->create();

        $resp = $this->uomTypeRepo->delete($uomType->id);

        $this->assertTrue($resp);
        $this->assertNull(UomType::find($uomType->id), 'UomType should not exist in DB');
    }
}
