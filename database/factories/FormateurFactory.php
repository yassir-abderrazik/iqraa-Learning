<?php

namespace Database\Factories;

use App\Models\Formateur;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FormateurFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Formateur::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'formateur_id' => User::where('type', 'formateur')->inRandomOrder()->first()->id,
            'specialty' => 'FORMATEUR specialty',
            'biography' =>  $this->faker->title
        ];
    }
}
