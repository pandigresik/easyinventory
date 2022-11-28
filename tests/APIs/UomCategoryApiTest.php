<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Inventory\UomCategory;

class UomCategoryApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_uom_category()
    {
        $uomCategory = UomCategory::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/inventory/uom_categories', $uomCategory
        );

        $this->assertApiResponse($uomCategory);
    }

    /**
     * @test
     */
    public function test_read_uom_category()
    {
        $uomCategory = UomCategory::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/inventory/uom_categories/'.$uomCategory->id
        );

        $this->assertApiResponse($uomCategory->toArray());
    }

    /**
     * @test
     */
    public function test_update_uom_category()
    {
        $uomCategory = UomCategory::factory()->create();
        $editedUomCategory = UomCategory::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/inventory/uom_categories/'.$uomCategory->id,
            $editedUomCategory
        );

        $this->assertApiResponse($editedUomCategory);
    }

    /**
     * @test
     */
    public function test_delete_uom_category()
    {
        $uomCategory = UomCategory::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/inventory/uom_categories/'.$uomCategory->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/inventory/uom_categories/'.$uomCategory->id
        );

        $this->response->assertStatus(404);
    }
}
