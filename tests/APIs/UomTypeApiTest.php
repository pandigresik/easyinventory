<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Inventory\UomType;

class UomTypeApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_uom_type()
    {
        $uomType = UomType::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/inventory/uom_types', $uomType
        );

        $this->assertApiResponse($uomType);
    }

    /**
     * @test
     */
    public function test_read_uom_type()
    {
        $uomType = UomType::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/inventory/uom_types/'.$uomType->id
        );

        $this->assertApiResponse($uomType->toArray());
    }

    /**
     * @test
     */
    public function test_update_uom_type()
    {
        $uomType = UomType::factory()->create();
        $editedUomType = UomType::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/inventory/uom_types/'.$uomType->id,
            $editedUomType
        );

        $this->assertApiResponse($editedUomType);
    }

    /**
     * @test
     */
    public function test_delete_uom_type()
    {
        $uomType = UomType::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/inventory/uom_types/'.$uomType->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/inventory/uom_types/'.$uomType->id
        );

        $this->response->assertStatus(404);
    }
}
