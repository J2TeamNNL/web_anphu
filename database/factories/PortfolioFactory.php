<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Nette\Utils\Random;
use App\Models\Portfolio;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Portfolio>
 */
class PortfolioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */


    protected $model = Portfolio::class;

    public function definition(): array
    {
        $types = [
            'villa' => ['modern', 'neoclassic'],
            'town_house' => ['2story', '3story', '5story', 'singleStory'],
            'trading_house' => ['appartment', 'office'],
        ];

        // Random type and matching category
        $type = $this->faker->randomElement(array_keys($types));
        $category = $this->faker->randomElement($types[$type]);

        return [
            'name' => $this->faker->sentence(3),
            'location' => $this->faker->city,
            'client' => $this->faker->name,
            'description' => $this->faker->paragraph,
            'type' => $type,
            'category' => $category,
            'year' => $this->faker->numberBetween(2018, now()->year),
            'image' => 'villa_modenn_1.webp',
            'image1' => null,
            'image2' => null,
            'image3' => null,
            'image4' => null,
        ];
    }
}
