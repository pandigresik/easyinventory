<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Base\ShippingCostSubsidy;

class ShippingCostSubsidyApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_shipping_cost_subsidy()
    {
        $shippingCostSubsidy = ShippingCostSubsidy::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/base/shipping_cost_subsidies', $shippingCostSubsidy
        );

        $this->assertApiResponse($shippingCostSubsidy);
    }

    /**
     * @test
     */
    public function test_read_shipping_cost_subsidy()
    {
        $shippingCostSubsidy = ShippingCostSubsidy::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/base/shipping_cost_subsidies/'.$shippingCostSubsidy->id
        );

        $this->assertApiResponse($shippingCostSubsidy->toArray());
    }

    /**
     * @test
     */
    public function test_update_shipping_cost_subsidy()
    {
        $shippingCostSubsidy = ShippingCostSubsidy::factory()->create();
        $editedShippingCostSubsidy = ShippingCostSubsidy::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/base/shipping_cost_subsidies/'.$shippingCostSubsidy->id,
            $editedShippingCostSubsidy
        );

        $this->assertApiResponse($editedShippingCostSubsidy);
    }

    /**
     * @test
     */
    public function test_delete_shipping_cost_subsidy()
    {
        $shippingCostSubsidy = ShippingCostSubsidy::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/base/shipping_cost_subsidies/'.$shippingCostSubsidy->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/base/shipping_cost_subsidies/'.$shippingCostSubsidy->id
        );

        $this->response->assertStatus(404);
    }
}
