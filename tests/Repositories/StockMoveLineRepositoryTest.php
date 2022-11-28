<?php namespace Tests\Repositories;

use App\Models\Inventory\StockMoveLine;
use App\Repositories\Inventory\StockMoveLineRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class StockMoveLineRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var StockMoveLineRepository
     */
    protected $stockMoveLineRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->stockMoveLineRepo = \App::make(StockMoveLineRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_stock_move_line()
    {
        $stockMoveLine = StockMoveLine::factory()->make()->toArray();

        $createdStockMoveLine = $this->stockMoveLineRepo->create($stockMoveLine);

        $createdStockMoveLine = $createdStockMoveLine->toArray();
        $this->assertArrayHasKey('id', $createdStockMoveLine);
        $this->assertNotNull($createdStockMoveLine['id'], 'Created StockMoveLine must have id specified');
        $this->assertNotNull(StockMoveLine::find($createdStockMoveLine['id']), 'StockMoveLine with given id must be in DB');
        $this->assertModelData($stockMoveLine, $createdStockMoveLine);
    }

    /**
     * @test read
     */
    public function test_read_stock_move_line()
    {
        $stockMoveLine = StockMoveLine::factory()->create();

        $dbStockMoveLine = $this->stockMoveLineRepo->find($stockMoveLine->id);

        $dbStockMoveLine = $dbStockMoveLine->toArray();
        $this->assertModelData($stockMoveLine->toArray(), $dbStockMoveLine);
    }

    /**
     * @test update
     */
    public function test_update_stock_move_line()
    {
        $stockMoveLine = StockMoveLine::factory()->create();
        $fakeStockMoveLine = StockMoveLine::factory()->make()->toArray();

        $updatedStockMoveLine = $this->stockMoveLineRepo->update($fakeStockMoveLine, $stockMoveLine->id);

        $this->assertModelData($fakeStockMoveLine, $updatedStockMoveLine->toArray());
        $dbStockMoveLine = $this->stockMoveLineRepo->find($stockMoveLine->id);
        $this->assertModelData($fakeStockMoveLine, $dbStockMoveLine->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_stock_move_line()
    {
        $stockMoveLine = StockMoveLine::factory()->create();

        $resp = $this->stockMoveLineRepo->delete($stockMoveLine->id);

        $this->assertTrue($resp);
        $this->assertNull(StockMoveLine::find($stockMoveLine->id), 'StockMoveLine should not exist in DB');
    }
}
