<?php namespace Tests\Repositories;

use App\Models\Base\ShippingCostSubsidy;
use App\Repositories\Base\ShippingCostSubsidyRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ShippingCostSubsidyRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ShippingCostSubsidyRepository
     */
    protected $shippingCostSubsidyRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->shippingCostSubsidyRepo = \App::make(ShippingCostSubsidyRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_shipping_cost_subsidy()
    {
        $shippingCostSubsidy = ShippingCostSubsidy::factory()->make()->toArray();

        $createdShippingCostSubsidy = $this->shippingCostSubsidyRepo->create($shippingCostSubsidy);

        $createdShippingCostSubsidy = $createdShippingCostSubsidy->toArray();
        $this->assertArrayHasKey('id', $createdShippingCostSubsidy);
        $this->assertNotNull($createdShippingCostSubsidy['id'], 'Created ShippingCostSubsidy must have id specified');
        $this->assertNotNull(ShippingCostSubsidy::find($createdShippingCostSubsidy['id']), 'ShippingCostSubsidy with given id must be in DB');
        $this->assertModelData($shippingCostSubsidy, $createdShippingCostSubsidy);
    }

    /**
     * @test read
     */
    public function test_read_shipping_cost_subsidy()
    {
        $shippingCostSubsidy = ShippingCostSubsidy::factory()->create();

        $dbShippingCostSubsidy = $this->shippingCostSubsidyRepo->find($shippingCostSubsidy->id);

        $dbShippingCostSubsidy = $dbShippingCostSubsidy->toArray();
        $this->assertModelData($shippingCostSubsidy->toArray(), $dbShippingCostSubsidy);
    }

    /**
     * @test update
     */
    public function test_update_shipping_cost_subsidy()
    {
        $shippingCostSubsidy = ShippingCostSubsidy::factory()->create();
        $fakeShippingCostSubsidy = ShippingCostSubsidy::factory()->make()->toArray();

        $updatedShippingCostSubsidy = $this->shippingCostSubsidyRepo->update($fakeShippingCostSubsidy, $shippingCostSubsidy->id);

        $this->assertModelData($fakeShippingCostSubsidy, $updatedShippingCostSubsidy->toArray());
        $dbShippingCostSubsidy = $this->shippingCostSubsidyRepo->find($shippingCostSubsidy->id);
        $this->assertModelData($fakeShippingCostSubsidy, $dbShippingCostSubsidy->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_shipping_cost_subsidy()
    {
        $shippingCostSubsidy = ShippingCostSubsidy::factory()->create();

        $resp = $this->shippingCostSubsidyRepo->delete($shippingCostSubsidy->id);

        $this->assertTrue($resp);
        $this->assertNull(ShippingCostSubsidy::find($shippingCostSubsidy->id), 'ShippingCostSubsidy should not exist in DB');
    }
}
