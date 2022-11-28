<?php namespace Tests\Repositories;

use App\Models\Inventory\Warehouse;
use App\Repositories\Inventory\WarehouseRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class WarehouseRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var WarehouseRepository
     */
    protected $warehouseRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->warehouseRepo = \App::make(WarehouseRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_warehouse()
    {
        $warehouse = Warehouse::factory()->make()->toArray();

        $createdWarehouse = $this->warehouseRepo->create($warehouse);

        $createdWarehouse = $createdWarehouse->toArray();
        $this->assertArrayHasKey('id', $createdWarehouse);
        $this->assertNotNull($createdWarehouse['id'], 'Created Warehouse must have id specified');
        $this->assertNotNull(Warehouse::find($createdWarehouse['id']), 'Warehouse with given id must be in DB');
        $this->assertModelData($warehouse, $createdWarehouse);
    }

    /**
     * @test read
     */
    public function test_read_warehouse()
    {
        $warehouse = Warehouse::factory()->create();

        $dbWarehouse = $this->warehouseRepo->find($warehouse->id);

        $dbWarehouse = $dbWarehouse->toArray();
        $this->assertModelData($warehouse->toArray(), $dbWarehouse);
    }

    /**
     * @test update
     */
    public function test_update_warehouse()
    {
        $warehouse = Warehouse::factory()->create();
        $fakeWarehouse = Warehouse::factory()->make()->toArray();

        $updatedWarehouse = $this->warehouseRepo->update($fakeWarehouse, $warehouse->id);

        $this->assertModelData($fakeWarehouse, $updatedWarehouse->toArray());
        $dbWarehouse = $this->warehouseRepo->find($warehouse->id);
        $this->assertModelData($fakeWarehouse, $dbWarehouse->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_warehouse()
    {
        $warehouse = Warehouse::factory()->create();

        $resp = $this->warehouseRepo->delete($warehouse->id);

        $this->assertTrue($resp);
        $this->assertNull(Warehouse::find($warehouse->id), 'Warehouse should not exist in DB');
    }
}
