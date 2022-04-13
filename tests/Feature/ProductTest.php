<?php

namespace Tests\Feature;

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
    use withFaker;
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
        $code = $this->faker->text(5);
        $title = $this->faker->name(5);
        $description = $this->faker->paragraph(5);
        $product_store_input = [
            "code"          =>  $code,
            "title"         =>  $title,
            "description"   =>  $description
        ];
        $response = $this->post('/api/products',$product_store_input);
        $response->assertStatus(200);
        $this->assertDatabaseHas('products', [
            'code' => $code
        ]);
    }

}
