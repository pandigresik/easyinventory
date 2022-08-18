<?php namespace Tests\Repositories;

use App\Models\Base\Customers;
use App\Repositories\Base\CustomersRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class CustomersRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var CustomersRepository
     */
    protected $customersRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->customersRepo = \App::make(CustomersRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_customers()
    {
        $customers = Customers::factory()->make()->toArray();

        $createdCustomers = $this->customersRepo->create($customers);

        $createdCustomers = $createdCustomers->toArray();
        $this->assertArrayHasKey('id', $createdCustomers);
        $this->assertNotNull($createdCustomers['id'], 'Created Customers must have id specified');
        $this->assertNotNull(Customers::find($createdCustomers['id']), 'Customers with given id must be in DB');
        $this->assertModelData($customers, $createdCustomers);
    }

    /**
     * @test read
     */
    public function test_read_customers()
    {
        $customers = Customers::factory()->create();

        $dbCustomers = $this->customersRepo->find($customers->id);

        $dbCustomers = $dbCustomers->toArray();
        $this->assertModelData($customers->toArray(), $dbCustomers);
    }

    /**
     * @test update
     */
    public function test_update_customers()
    {
        $customers = Customers::factory()->create();
        $fakeCustomers = Customers::factory()->make()->toArray();

        $updatedCustomers = $this->customersRepo->update($fakeCustomers, $customers->id);

        $this->assertModelData($fakeCustomers, $updatedCustomers->toArray());
        $dbCustomers = $this->customersRepo->find($customers->id);
        $this->assertModelData($fakeCustomers, $dbCustomers->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_customers()
    {
        $customers = Customers::factory()->create();

        $resp = $this->customersRepo->delete($customers->id);

        $this->assertTrue($resp);
        $this->assertNull(Customers::find($customers->id), 'Customers should not exist in DB');
    }
}
