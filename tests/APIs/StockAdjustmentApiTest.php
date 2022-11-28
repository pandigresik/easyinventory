<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Inventory\StockAdjustment;

class StockAdjustmentApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_stock_adjustment()
    {
        $stockAdjustment = StockAdjustment::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/inventory/stock_adjustments', $stockAdjustment
        );

        $this->assertApiResponse($stockAdjustment);
    }

    /**
     * @test
     */
    public function test_read_stock_adjustment()
    {
        $stockAdjustment = StockAdjustment::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/inventory/stock_adjustments/'.$stockAdjustment->id
        );

        $this->assertApiResponse($stockAdjustment->toArray());
    }

    /**
     * @test
     */
    public function test_update_stock_adjustment()
    {
        $stockAdjustment = StockAdjustment::factory()->create();
        $editedStockAdjustment = StockAdjustment::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/inventory/stock_adjustments/'.$stockAdjustment->id,
            $editedStockAdjustment
        );

        $this->assertApiResponse($editedStockAdjustment);
    }

    /**
     * @test
     */
    public function test_delete_stock_adjustment()
    {
        $stockAdjustment = StockAdjustment::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/inventory/stock_adjustments/'.$stockAdjustment->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/inventory/stock_adjustments/'.$stockAdjustment->id
        );

        $this->response->assertStatus(404);
    }
}
