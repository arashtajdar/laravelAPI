<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use withFaker, DatabaseTransactions;
    private array $product_store_input;

    protected function setUp() : void
    {
        parent::setUp();
        $code = $this->faker->text(5);
        $title = $this->faker->name(5);
        $description = $this->faker->paragraph(1);
        $this->product_store_input = [
            "code"          =>  $code,
            "title"         =>  $title,
            "description"   =>  $description
        ];
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
        $response = $this->post('/api/products',$this->product_store_input);
        $response->assertStatus(200);
        $this->assertDatabaseHas('products', [
            'code' => $this->product_store_input["code"]
        ]);
    }

    public function test_product_show_functionality()
    {
        $id = $this->post('/api/products',$this->product_store_input)->json("id");
        $response = $this->get('/api/products/'.$id);
        $response->assertStatus(200);
    }

    public function test_product_update_functionality()
    {
        $id = $this->post('/api/products',$this->product_store_input)->json("id");
        $response = $this->put('/api/products/'.$id,$this->product_store_input);
        $response->assertStatus(200);
    }

    public function test_product_delete_functionality()
    {
        $id = $this->post('/api/products',$this->product_store_input)->json("id");
        $response = $this->delete('/api/products/'.$id);
        $response->assertStatus(200);
    }
    protected function tearDown() : void
    {
        parent::tearDown();
    }


}
