<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str; // Used for UUID generation

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Define a static list of 10 candy shop products
        // This array will be indexed from 0 to 9.
        $productsData = [
            [
                'name' => 'Gummy Bears',
                'description' => 'Chewy and sweet fruit-flavored gummy bears, a classic candy shop favorite.',
            ],
            [
                'name' => 'Premium Chocolate Bar',
                'description' => 'Rich and smooth milk chocolate bar, perfect for a luxurious treat.',
            ],
            [
                'name' => 'Swirly Lollipops',
                'description' => 'Large, colorful swirly lollipops with a variety of fruit flavors.',
            ],
            [
                'name' => 'Sour Worms',
                'description' => 'Tangy and chewy sour worms, packed with a zesty punch.',
            ],
            [
                'name' => 'Fluffy Marshmallows',
                'description' => 'Soft, melt-in-your-mouth marshmallows, great for hot chocolate or roasting.',
            ],
            [
                'name' => 'Assorted Hard Candy Mix',
                'description' => 'A vibrant mix of individually wrapped hard candies with diverse flavors.',
            ],
            [
                'name' => 'Creamy Caramel Chews',
                'description' => 'Indulgent, buttery caramel chews that melt in your mouth.',
            ],
            [
                'name' => 'Gourmet Jelly Beans',
                'description' => 'A delightful assortment of gourmet jelly beans with unique and classic flavors.',
            ],
            [
                'name' => 'Puffy Cotton Candy',
                'description' => 'Light and airy spun sugar, a carnival classic in a convenient pack.',
            ],
            [
                'name' => 'Sparkling Rock Candy',
                'description' => 'Beautiful crystalized sugar on a stick, available in various colors and flavors.',
            ],
        ];

        static $productIndex = 0;

        $currentProduct = $productsData[$productIndex % count($productsData)];

        $productIndex++;

        return [
            'id' => Str::uuid(), 
            'name' => $currentProduct['name'],
            'description' => $currentProduct['description'],
            'price' => $this->faker->numberBetween(10000, 200000),
            'stock' => $this->faker->numberBetween(1, 50), 
            'image' => 'products/' . ($productIndex) . '.jpg', // Image names: products/1.jpg, products/2.jpg, ..., products/10.jpg
        ];
    }
}
