<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Product
     *
     * @var string
     */
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $code = $this->faker->text(5);
        $title = $this->faker->name(5);
        $description = $this->faker->paragraph(1);
        return [
            "id" => 1,
            "code" => $code,
            "title" => $title,
            "description" => $description
        ];
    }
}
