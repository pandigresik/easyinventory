<?php namespace Tests\Repositories;

use App\Models\Inventory\UomCategory;
use App\Repositories\Inventory\UomCategoryRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class UomCategoryRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var UomCategoryRepository
     */
    protected $uomCategoryRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->uomCategoryRepo = \App::make(UomCategoryRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_uom_category()
    {
        $uomCategory = UomCategory::factory()->make()->toArray();

        $createdUomCategory = $this->uomCategoryRepo->create($uomCategory);

        $createdUomCategory = $createdUomCategory->toArray();
        $this->assertArrayHasKey('id', $createdUomCategory);
        $this->assertNotNull($createdUomCategory['id'], 'Created UomCategory must have id specified');
        $this->assertNotNull(UomCategory::find($createdUomCategory['id']), 'UomCategory with given id must be in DB');
        $this->assertModelData($uomCategory, $createdUomCategory);
    }

    /**
     * @test read
     */
    public function test_read_uom_category()
    {
        $uomCategory = UomCategory::factory()->create();

        $dbUomCategory = $this->uomCategoryRepo->find($uomCategory->id);

        $dbUomCategory = $dbUomCategory->toArray();
        $this->assertModelData($uomCategory->toArray(), $dbUomCategory);
    }

    /**
     * @test update
     */
    public function test_update_uom_category()
    {
        $uomCategory = UomCategory::factory()->create();
        $fakeUomCategory = UomCategory::factory()->make()->toArray();

        $updatedUomCategory = $this->uomCategoryRepo->update($fakeUomCategory, $uomCategory->id);

        $this->assertModelData($fakeUomCategory, $updatedUomCategory->toArray());
        $dbUomCategory = $this->uomCategoryRepo->find($uomCategory->id);
        $this->assertModelData($fakeUomCategory, $dbUomCategory->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_uom_category()
    {
        $uomCategory = UomCategory::factory()->create();

        $resp = $this->uomCategoryRepo->delete($uomCategory->id);

        $this->assertTrue($resp);
        $this->assertNull(UomCategory::find($uomCategory->id), 'UomCategory should not exist in DB');
    }
}
