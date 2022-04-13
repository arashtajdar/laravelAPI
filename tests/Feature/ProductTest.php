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
    private $id;

    protected function setUp(): void
    {
        parent::setUp();
        $UserModel = User::factory()->make();
        Sanctum::actingAs($UserModel);
        $productModel = Product::factory()->make();
        $this->product = $productModel->getAttributes();
    }
    public function test_product_functionalities()
    {
        $response = $this->get('/api/products');
        $response->assertStatus(200);
    // test product store functionality

        // Test if we do not have any input for product store method, it will fail and respond with 422
        $response = $this->post('/api/products');
        $response->assertStatus(422);

        // Test if we send correct data to product store endpoint, it will be ok
        $response = $this->post('/api/products', $this->product);
        $this->id = $response->json("id");
        $response->assertStatus(200);
        $this->assertDatabaseHas('products', [
            'code' => $this->product["code"]
        ]);
    // test product show functionality
        $response = $this->get('/api/products/' . $this->id);
        $response->assertStatus(200);
    // test product update functionality
        $response = $this->put('/api/products/' . $this->id, $this->product);
        // Todo : check if it is really updated or not
        $response->assertStatus(200);
    // test product delete functionality
        $response = $this->delete('/api/products/' . $this->id);
        // Todo : check if it is really deleted or not
        $response->assertStatus(200);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }


}
