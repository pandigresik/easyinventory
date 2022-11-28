<?php namespace Tests\Repositories;

use App\Models\Inventory\StockAdjustment;
use App\Repositories\Inventory\StockAdjustmentRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class StockAdjustmentRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var StockAdjustmentRepository
     */
    protected $stockAdjustmentRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->stockAdjustmentRepo = \App::make(StockAdjustmentRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_stock_adjustment()
    {
        $stockAdjustment = StockAdjustment::factory()->make()->toArray();

        $createdStockAdjustment = $this->stockAdjustmentRepo->create($stockAdjustment);

        $createdStockAdjustment = $createdStockAdjustment->toArray();
        $this->assertArrayHasKey('id', $createdStockAdjustment);
        $this->assertNotNull($createdStockAdjustment['id'], 'Created StockAdjustment must have id specified');
        $this->assertNotNull(StockAdjustment::find($createdStockAdjustment['id']), 'StockAdjustment with given id must be in DB');
        $this->assertModelData($stockAdjustment, $createdStockAdjustment);
    }

    /**
     * @test read
     */
    public function test_read_stock_adjustment()
    {
        $stockAdjustment = StockAdjustment::factory()->create();

        $dbStockAdjustment = $this->stockAdjustmentRepo->find($stockAdjustment->id);

        $dbStockAdjustment = $dbStockAdjustment->toArray();
        $this->assertModelData($stockAdjustment->toArray(), $dbStockAdjustment);
    }

    /**
     * @test update
     */
    public function test_update_stock_adjustment()
    {
        $stockAdjustment = StockAdjustment::factory()->create();
        $fakeStockAdjustment = StockAdjustment::factory()->make()->toArray();

        $updatedStockAdjustment = $this->stockAdjustmentRepo->update($fakeStockAdjustment, $stockAdjustment->id);

        $this->assertModelData($fakeStockAdjustment, $updatedStockAdjustment->toArray());
        $dbStockAdjustment = $this->stockAdjustmentRepo->find($stockAdjustment->id);
        $this->assertModelData($fakeStockAdjustment, $dbStockAdjustment->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_stock_adjustment()
    {
        $stockAdjustment = StockAdjustment::factory()->create();

        $resp = $this->stockAdjustmentRepo->delete($stockAdjustment->id);

        $this->assertTrue($resp);
        $this->assertNull(StockAdjustment::find($stockAdjustment->id), 'StockAdjustment should not exist in DB');
    }
}
