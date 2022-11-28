<?php namespace Tests\Repositories;

use App\Models\Inventory\StockMoveType;
use App\Repositories\Inventory\StockMoveTypeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class StockMoveTypeRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var StockMoveTypeRepository
     */
    protected $stockMoveTypeRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->stockMoveTypeRepo = \App::make(StockMoveTypeRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_stock_move_type()
    {
        $stockMoveType = StockMoveType::factory()->make()->toArray();

        $createdStockMoveType = $this->stockMoveTypeRepo->create($stockMoveType);

        $createdStockMoveType = $createdStockMoveType->toArray();
        $this->assertArrayHasKey('id', $createdStockMoveType);
        $this->assertNotNull($createdStockMoveType['id'], 'Created StockMoveType must have id specified');
        $this->assertNotNull(StockMoveType::find($createdStockMoveType['id']), 'StockMoveType with given id must be in DB');
        $this->assertModelData($stockMoveType, $createdStockMoveType);
    }

    /**
     * @test read
     */
    public function test_read_stock_move_type()
    {
        $stockMoveType = StockMoveType::factory()->create();

        $dbStockMoveType = $this->stockMoveTypeRepo->find($stockMoveType->id);

        $dbStockMoveType = $dbStockMoveType->toArray();
        $this->assertModelData($stockMoveType->toArray(), $dbStockMoveType);
    }

    /**
     * @test update
     */
    public function test_update_stock_move_type()
    {
        $stockMoveType = StockMoveType::factory()->create();
        $fakeStockMoveType = StockMoveType::factory()->make()->toArray();

        $updatedStockMoveType = $this->stockMoveTypeRepo->update($fakeStockMoveType, $stockMoveType->id);

        $this->assertModelData($fakeStockMoveType, $updatedStockMoveType->toArray());
        $dbStockMoveType = $this->stockMoveTypeRepo->find($stockMoveType->id);
        $this->assertModelData($fakeStockMoveType, $dbStockMoveType->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_stock_move_type()
    {
        $stockMoveType = StockMoveType::factory()->create();

        $resp = $this->stockMoveTypeRepo->delete($stockMoveType->id);

        $this->assertTrue($resp);
        $this->assertNull(StockMoveType::find($stockMoveType->id), 'StockMoveType should not exist in DB');
    }
}
