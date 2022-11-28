<?php namespace Tests\Repositories;

use App\Models\Inventory\StorageLocation;
use App\Repositories\Inventory\StorageLocationRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class StorageLocationRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var StorageLocationRepository
     */
    protected $storageLocationRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->storageLocationRepo = \App::make(StorageLocationRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_storage_location()
    {
        $storageLocation = StorageLocation::factory()->make()->toArray();

        $createdStorageLocation = $this->storageLocationRepo->create($storageLocation);

        $createdStorageLocation = $createdStorageLocation->toArray();
        $this->assertArrayHasKey('id', $createdStorageLocation);
        $this->assertNotNull($createdStorageLocation['id'], 'Created StorageLocation must have id specified');
        $this->assertNotNull(StorageLocation::find($createdStorageLocation['id']), 'StorageLocation with given id must be in DB');
        $this->assertModelData($storageLocation, $createdStorageLocation);
    }

    /**
     * @test read
     */
    public function test_read_storage_location()
    {
        $storageLocation = StorageLocation::factory()->create();

        $dbStorageLocation = $this->storageLocationRepo->find($storageLocation->id);

        $dbStorageLocation = $dbStorageLocation->toArray();
        $this->assertModelData($storageLocation->toArray(), $dbStorageLocation);
    }

    /**
     * @test update
     */
    public function test_update_storage_location()
    {
        $storageLocation = StorageLocation::factory()->create();
        $fakeStorageLocation = StorageLocation::factory()->make()->toArray();

        $updatedStorageLocation = $this->storageLocationRepo->update($fakeStorageLocation, $storageLocation->id);

        $this->assertModelData($fakeStorageLocation, $updatedStorageLocation->toArray());
        $dbStorageLocation = $this->storageLocationRepo->find($storageLocation->id);
        $this->assertModelData($fakeStorageLocation, $dbStorageLocation->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_storage_location()
    {
        $storageLocation = StorageLocation::factory()->create();

        $resp = $this->storageLocationRepo->delete($storageLocation->id);

        $this->assertTrue($resp);
        $this->assertNull(StorageLocation::find($storageLocation->id), 'StorageLocation should not exist in DB');
    }
}
