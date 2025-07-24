<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Enums\CategoryType;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        $name = $this->faker->words(2, true);
        return [
            'name' => ucfirst($name),
            'slug' => Str::slug($name),
            'type' => $this->faker->randomElement(CategoryType::values()),
            'parent_id' => null,
        ];
    }
}
