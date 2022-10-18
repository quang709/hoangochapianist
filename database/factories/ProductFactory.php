<?php

namespace Database\Factories;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'name_url' => Str::slug($this->faker->name),
            'price'=>$this->faker->numberBetween($min = 150000, $max = 600000),
            'description'=>$this->faker->text,
            'image'=>$this->faker->imageUrl
        ];
    }
}
