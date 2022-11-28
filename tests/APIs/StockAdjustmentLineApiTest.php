<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Inventory\StockAdjustmentLine;

class StockAdjustmentLineApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_stock_adjustment_line()
    {
        $stockAdjustmentLine = StockAdjustmentLine::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/inventory/stock_adjustment_lines', $stockAdjustmentLine
        );

        $this->assertApiResponse($stockAdjustmentLine);
    }

    /**
     * @test
     */
    public function test_read_stock_adjustment_line()
    {
        $stockAdjustmentLine = StockAdjustmentLine::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/inventory/stock_adjustment_lines/'.$stockAdjustmentLine->id
        );

        $this->assertApiResponse($stockAdjustmentLine->toArray());
    }

    /**
     * @test
     */
    public function test_update_stock_adjustment_line()
    {
        $stockAdjustmentLine = StockAdjustmentLine::factory()->create();
        $editedStockAdjustmentLine = StockAdjustmentLine::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/inventory/stock_adjustment_lines/'.$stockAdjustmentLine->id,
            $editedStockAdjustmentLine
        );

        $this->assertApiResponse($editedStockAdjustmentLine);
    }

    /**
     * @test
     */
    public function test_delete_stock_adjustment_line()
    {
        $stockAdjustmentLine = StockAdjustmentLine::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/inventory/stock_adjustment_lines/'.$stockAdjustmentLine->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/inventory/stock_adjustment_lines/'.$stockAdjustmentLine->id
        );

        $this->response->assertStatus(404);
    }
}
