<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Inventory\StockProduct;

class StockProductApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_stock_product()
    {
        $stockProduct = StockProduct::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/inventory/stock_products', $stockProduct
        );

        $this->assertApiResponse($stockProduct);
    }

    /**
     * @test
     */
    public function test_read_stock_product()
    {
        $stockProduct = StockProduct::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/inventory/stock_products/'.$stockProduct->id
        );

        $this->assertApiResponse($stockProduct->toArray());
    }

    /**
     * @test
     */
    public function test_update_stock_product()
    {
        $stockProduct = StockProduct::factory()->create();
        $editedStockProduct = StockProduct::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/inventory/stock_products/'.$stockProduct->id,
            $editedStockProduct
        );

        $this->assertApiResponse($editedStockProduct);
    }

    /**
     * @test
     */
    public function test_delete_stock_product()
    {
        $stockProduct = StockProduct::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/inventory/stock_products/'.$stockProduct->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/inventory/stock_products/'.$stockProduct->id
        );

        $this->response->assertStatus(404);
    }
}
