<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            // Pastikan ada vendor di database atau gunakan factory vendor juga
            'vendor_id' => Vendor::factory(), // atau bisa hardcode jika untuk seed testing

            'sku' => strtoupper('SKU-'.$this->faker->unique()->bothify('??###')),
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(10),
            'price' => $this->faker->randomFloat(2, 10000, 100000), // e.g. 15000.00
            'stock' => $this->faker->numberBetween(0, 1000),
            'is_active' => $this->faker->boolean(90),
        ];
    }
}
