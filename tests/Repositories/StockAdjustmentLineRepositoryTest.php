<?php namespace Tests\Repositories;

use App\Models\Inventory\StockAdjustmentLine;
use App\Repositories\Inventory\StockAdjustmentLineRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class StockAdjustmentLineRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var StockAdjustmentLineRepository
     */
    protected $stockAdjustmentLineRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->stockAdjustmentLineRepo = \App::make(StockAdjustmentLineRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_stock_adjustment_line()
    {
        $stockAdjustmentLine = StockAdjustmentLine::factory()->make()->toArray();

        $createdStockAdjustmentLine = $this->stockAdjustmentLineRepo->create($stockAdjustmentLine);

        $createdStockAdjustmentLine = $createdStockAdjustmentLine->toArray();
        $this->assertArrayHasKey('id', $createdStockAdjustmentLine);
        $this->assertNotNull($createdStockAdjustmentLine['id'], 'Created StockAdjustmentLine must have id specified');
        $this->assertNotNull(StockAdjustmentLine::find($createdStockAdjustmentLine['id']), 'StockAdjustmentLine with given id must be in DB');
        $this->assertModelData($stockAdjustmentLine, $createdStockAdjustmentLine);
    }

    /**
     * @test read
     */
    public function test_read_stock_adjustment_line()
    {
        $stockAdjustmentLine = StockAdjustmentLine::factory()->create();

        $dbStockAdjustmentLine = $this->stockAdjustmentLineRepo->find($stockAdjustmentLine->id);

        $dbStockAdjustmentLine = $dbStockAdjustmentLine->toArray();
        $this->assertModelData($stockAdjustmentLine->toArray(), $dbStockAdjustmentLine);
    }

    /**
     * @test update
     */
    public function test_update_stock_adjustment_line()
    {
        $stockAdjustmentLine = StockAdjustmentLine::factory()->create();
        $fakeStockAdjustmentLine = StockAdjustmentLine::factory()->make()->toArray();

        $updatedStockAdjustmentLine = $this->stockAdjustmentLineRepo->update($fakeStockAdjustmentLine, $stockAdjustmentLine->id);

        $this->assertModelData($fakeStockAdjustmentLine, $updatedStockAdjustmentLine->toArray());
        $dbStockAdjustmentLine = $this->stockAdjustmentLineRepo->find($stockAdjustmentLine->id);
        $this->assertModelData($fakeStockAdjustmentLine, $dbStockAdjustmentLine->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_stock_adjustment_line()
    {
        $stockAdjustmentLine = StockAdjustmentLine::factory()->create();

        $resp = $this->stockAdjustmentLineRepo->delete($stockAdjustmentLine->id);

        $this->assertTrue($resp);
        $this->assertNull(StockAdjustmentLine::find($stockAdjustmentLine->id), 'StockAdjustmentLine should not exist in DB');
    }
}
