<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Inventory\StockMoveType;

class StockMoveTypeApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_stock_move_type()
    {
        $stockMoveType = StockMoveType::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/inventory/stock_move_types', $stockMoveType
        );

        $this->assertApiResponse($stockMoveType);
    }

    /**
     * @test
     */
    public function test_read_stock_move_type()
    {
        $stockMoveType = StockMoveType::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/inventory/stock_move_types/'.$stockMoveType->id
        );

        $this->assertApiResponse($stockMoveType->toArray());
    }

    /**
     * @test
     */
    public function test_update_stock_move_type()
    {
        $stockMoveType = StockMoveType::factory()->create();
        $editedStockMoveType = StockMoveType::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/inventory/stock_move_types/'.$stockMoveType->id,
            $editedStockMoveType
        );

        $this->assertApiResponse($editedStockMoveType);
    }

    /**
     * @test
     */
    public function test_delete_stock_move_type()
    {
        $stockMoveType = StockMoveType::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/inventory/stock_move_types/'.$stockMoveType->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/inventory/stock_move_types/'.$stockMoveType->id
        );

        $this->response->assertStatus(404);
    }
}
