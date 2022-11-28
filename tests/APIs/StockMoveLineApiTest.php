<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Inventory\StockMoveLine;

class StockMoveLineApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_stock_move_line()
    {
        $stockMoveLine = StockMoveLine::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/inventory/stock_move_lines', $stockMoveLine
        );

        $this->assertApiResponse($stockMoveLine);
    }

    /**
     * @test
     */
    public function test_read_stock_move_line()
    {
        $stockMoveLine = StockMoveLine::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/inventory/stock_move_lines/'.$stockMoveLine->id
        );

        $this->assertApiResponse($stockMoveLine->toArray());
    }

    /**
     * @test
     */
    public function test_update_stock_move_line()
    {
        $stockMoveLine = StockMoveLine::factory()->create();
        $editedStockMoveLine = StockMoveLine::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/inventory/stock_move_lines/'.$stockMoveLine->id,
            $editedStockMoveLine
        );

        $this->assertApiResponse($editedStockMoveLine);
    }

    /**
     * @test
     */
    public function test_delete_stock_move_line()
    {
        $stockMoveLine = StockMoveLine::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/inventory/stock_move_lines/'.$stockMoveLine->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/inventory/stock_move_lines/'.$stockMoveLine->id
        );

        $this->response->assertStatus(404);
    }
}
