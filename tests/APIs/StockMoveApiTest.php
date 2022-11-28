<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Inventory\StockMove;

class StockMoveApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_stock_move()
    {
        $stockMove = StockMove::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/inventory/stock_moves', $stockMove
        );

        $this->assertApiResponse($stockMove);
    }

    /**
     * @test
     */
    public function test_read_stock_move()
    {
        $stockMove = StockMove::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/inventory/stock_moves/'.$stockMove->id
        );

        $this->assertApiResponse($stockMove->toArray());
    }

    /**
     * @test
     */
    public function test_update_stock_move()
    {
        $stockMove = StockMove::factory()->create();
        $editedStockMove = StockMove::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/inventory/stock_moves/'.$stockMove->id,
            $editedStockMove
        );

        $this->assertApiResponse($editedStockMove);
    }

    /**
     * @test
     */
    public function test_delete_stock_move()
    {
        $stockMove = StockMove::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/inventory/stock_moves/'.$stockMove->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/inventory/stock_moves/'.$stockMove->id
        );

        $this->response->assertStatus(404);
    }
}
