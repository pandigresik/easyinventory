<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Inventory\StorageLocation;

class StorageLocationApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_storage_location()
    {
        $storageLocation = StorageLocation::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/inventory/storage_locations', $storageLocation
        );

        $this->assertApiResponse($storageLocation);
    }

    /**
     * @test
     */
    public function test_read_storage_location()
    {
        $storageLocation = StorageLocation::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/inventory/storage_locations/'.$storageLocation->id
        );

        $this->assertApiResponse($storageLocation->toArray());
    }

    /**
     * @test
     */
    public function test_update_storage_location()
    {
        $storageLocation = StorageLocation::factory()->create();
        $editedStorageLocation = StorageLocation::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/inventory/storage_locations/'.$storageLocation->id,
            $editedStorageLocation
        );

        $this->assertApiResponse($editedStorageLocation);
    }

    /**
     * @test
     */
    public function test_delete_storage_location()
    {
        $storageLocation = StorageLocation::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/inventory/storage_locations/'.$storageLocation->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/inventory/storage_locations/'.$storageLocation->id
        );

        $this->response->assertStatus(404);
    }
}
