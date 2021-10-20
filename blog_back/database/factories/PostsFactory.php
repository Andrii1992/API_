<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\Posts;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model =  Posts::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
           // 'id' => $this->faker->unique()->numberBetween(1,20000),
            'title' => $this->faker->name,
            'content' =>  $this->faker->paragraph,
            'excerpt' => $this->faker->sentence,
            'status' => rand(0, 1), 
            'type'=>  $this->faker->sentence,
            'img'=>'https://source.unsplash.com/random',
            'img_thumb' => 'https://source.unsplash.com/random',
            'created_at' => now(),
            'updated_at'    => now(),
        ];
    }
}
