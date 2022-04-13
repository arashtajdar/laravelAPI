<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic feature to test product endpoint functionalities.
     *
     * @return void
     */
    use withFaker;
    use DatabaseTransactions;

    private array $product;

    protected function setUp(): void
    {
        parent::setUp();
        $UserModel = User::factory()->make();
        Sanctum::actingAs($UserModel);
        $productModel = Product::factory()->make();
        $this->product = $productModel->getAttributes();
    }
    public function test_product_index_functionality()
    {
        $response = $this->get('/api/products');
        $response->assertStatus(200);
    }

    public function test_product_store_functionality()
    {
        // Test if we do not have any input for product store method, it will fail and respond with 422
        $response = $this->post('/api/products');
        $response->assertStatus(422);

        // Test if we send correct data to product store endpoint, it will be ok
        $response = $this->post('/api/products', $this->product);
        $response->assertStatus(200);
        $this->assertDatabaseHas('products', [
            'code' => $this->product["code"]
        ]);
    }

    public function test_product_show_functionality()
    {
        $id = $this->post('/api/products', $this->product)->json("id");
        $response = $this->get('/api/products/' . $id);
        $response->assertStatus(200);
    }

    public function test_product_update_functionality()
    {
        $id = $this->post('/api/products', $this->product)->json("id");
        $response = $this->put('/api/products/' . $id, $this->product);
        $response->assertStatus(200);
    }

    public function test_product_delete_functionality()
    {
        $id = $this->post('/api/products', $this->product)->json("id");
        $response = $this->delete('/api/products/' . $id);
        $response->assertStatus(200);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }


}
