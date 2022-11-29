<?php namespace Tests\Repositories;

use App\Models\Inventory\StockProduct;
use App\Repositories\Inventory\StockProductRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class StockProductRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var StockProductRepository
     */
    protected $stockProductRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->stockProductRepo = \App::make(StockProductRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_stock_product()
    {
        $stockProduct = StockProduct::factory()->make()->toArray();

        $createdStockProduct = $this->stockProductRepo->create($stockProduct);

        $createdStockProduct = $createdStockProduct->toArray();
        $this->assertArrayHasKey('id', $createdStockProduct);
        $this->assertNotNull($createdStockProduct['id'], 'Created StockProduct must have id specified');
        $this->assertNotNull(StockProduct::find($createdStockProduct['id']), 'StockProduct with given id must be in DB');
        $this->assertModelData($stockProduct, $createdStockProduct);
    }

    /**
     * @test read
     */
    public function test_read_stock_product()
    {
        $stockProduct = StockProduct::factory()->create();

        $dbStockProduct = $this->stockProductRepo->find($stockProduct->id);

        $dbStockProduct = $dbStockProduct->toArray();
        $this->assertModelData($stockProduct->toArray(), $dbStockProduct);
    }

    /**
     * @test update
     */
    public function test_update_stock_product()
    {
        $stockProduct = StockProduct::factory()->create();
        $fakeStockProduct = StockProduct::factory()->make()->toArray();

        $updatedStockProduct = $this->stockProductRepo->update($fakeStockProduct, $stockProduct->id);

        $this->assertModelData($fakeStockProduct, $updatedStockProduct->toArray());
        $dbStockProduct = $this->stockProductRepo->find($stockProduct->id);
        $this->assertModelData($fakeStockProduct, $dbStockProduct->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_stock_product()
    {
        $stockProduct = StockProduct::factory()->create();

        $resp = $this->stockProductRepo->delete($stockProduct->id);

        $this->assertTrue($resp);
        $this->assertNull(StockProduct::find($stockProduct->id), 'StockProduct should not exist in DB');
    }
}
