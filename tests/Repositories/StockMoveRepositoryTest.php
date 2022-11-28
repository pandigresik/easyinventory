<?php namespace Tests\Repositories;

use App\Models\Inventory\StockMove;
use App\Repositories\Inventory\StockMoveRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class StockMoveRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var StockMoveRepository
     */
    protected $stockMoveRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->stockMoveRepo = \App::make(StockMoveRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_stock_move()
    {
        $stockMove = StockMove::factory()->make()->toArray();

        $createdStockMove = $this->stockMoveRepo->create($stockMove);

        $createdStockMove = $createdStockMove->toArray();
        $this->assertArrayHasKey('id', $createdStockMove);
        $this->assertNotNull($createdStockMove['id'], 'Created StockMove must have id specified');
        $this->assertNotNull(StockMove::find($createdStockMove['id']), 'StockMove with given id must be in DB');
        $this->assertModelData($stockMove, $createdStockMove);
    }

    /**
     * @test read
     */
    public function test_read_stock_move()
    {
        $stockMove = StockMove::factory()->create();

        $dbStockMove = $this->stockMoveRepo->find($stockMove->id);

        $dbStockMove = $dbStockMove->toArray();
        $this->assertModelData($stockMove->toArray(), $dbStockMove);
    }

    /**
     * @test update
     */
    public function test_update_stock_move()
    {
        $stockMove = StockMove::factory()->create();
        $fakeStockMove = StockMove::factory()->make()->toArray();

        $updatedStockMove = $this->stockMoveRepo->update($fakeStockMove, $stockMove->id);

        $this->assertModelData($fakeStockMove, $updatedStockMove->toArray());
        $dbStockMove = $this->stockMoveRepo->find($stockMove->id);
        $this->assertModelData($fakeStockMove, $dbStockMove->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_stock_move()
    {
        $stockMove = StockMove::factory()->create();

        $resp = $this->stockMoveRepo->delete($stockMove->id);

        $this->assertTrue($resp);
        $this->assertNull(StockMove::find($stockMove->id), 'StockMove should not exist in DB');
    }
}
