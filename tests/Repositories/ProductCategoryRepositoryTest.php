<?php namespace Tests\Repositories;

use App\Models\Inventory\ProductCategory;
use App\Repositories\Inventory\ProductCategoryRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ProductCategoryRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ProductCategoryRepository
     */
    protected $productCategoryRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->productCategoryRepo = \App::make(ProductCategoryRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_product_category()
    {
        $productCategory = ProductCategory::factory()->make()->toArray();

        $createdProductCategory = $this->productCategoryRepo->create($productCategory);

        $createdProductCategory = $createdProductCategory->toArray();
        $this->assertArrayHasKey('id', $createdProductCategory);
        $this->assertNotNull($createdProductCategory['id'], 'Created ProductCategory must have id specified');
        $this->assertNotNull(ProductCategory::find($createdProductCategory['id']), 'ProductCategory with given id must be in DB');
        $this->assertModelData($productCategory, $createdProductCategory);
    }

    /**
     * @test read
     */
    public function test_read_product_category()
    {
        $productCategory = ProductCategory::factory()->create();

        $dbProductCategory = $this->productCategoryRepo->find($productCategory->id);

        $dbProductCategory = $dbProductCategory->toArray();
        $this->assertModelData($productCategory->toArray(), $dbProductCategory);
    }

    /**
     * @test update
     */
    public function test_update_product_category()
    {
        $productCategory = ProductCategory::factory()->create();
        $fakeProductCategory = ProductCategory::factory()->make()->toArray();

        $updatedProductCategory = $this->productCategoryRepo->update($fakeProductCategory, $productCategory->id);

        $this->assertModelData($fakeProductCategory, $updatedProductCategory->toArray());
        $dbProductCategory = $this->productCategoryRepo->find($productCategory->id);
        $this->assertModelData($fakeProductCategory, $dbProductCategory->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_product_category()
    {
        $productCategory = ProductCategory::factory()->create();

        $resp = $this->productCategoryRepo->delete($productCategory->id);

        $this->assertTrue($resp);
        $this->assertNull(ProductCategory::find($productCategory->id), 'ProductCategory should not exist in DB');
    }
}
