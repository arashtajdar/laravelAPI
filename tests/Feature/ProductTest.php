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
        $product_store_input = [
            "code"=>"P003",
            "title"=>"Second product",
            "description"=>"Description of second product"
        ];
        $response = $this->post('/api/products',$product_store_input);
        $response->assertStatus(200);
    }

}
