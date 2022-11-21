<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class todoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     
    public function definition()
    {
        return [
            // $table->id();
            // $table->string('title');
            // $table->string('details');
            // $table->date('deadline');
            // $table->unsignedBigInteger('priority_id');
            // $table->unsignedBigInteger('user_id');
            // $table->foreign('user_id')->references('id')->on('users');
            // $table->foreign('priority_id')->references('id')->on('priorities');
            // $table->timestamps();

            // 'name' => fake()->name(),


            'title' => $this->faker->unique()->realText(15), 
            'details' => $this->faker->realText($maxNbChars= 50), 
            'priority_id' => $this->faker->numberBetween(1,3), 
            'deadline' => $this->faker->dateTimeBetween('-5 days','+5 days'),           
            'user_id' => 1,
            // 'user_id'=> 1,
    

        ];
    }
}
