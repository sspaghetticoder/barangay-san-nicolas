<?php

namespace Database\Factories;

use App\Models\Resident;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Resident>
 */
class ResidentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'last_name' => $this->faker->name(),
            'first_name' => $this->faker->name(),
            'middle_name' => $this->faker->name(),
            'suffix' => $this->faker->name(),
            'email' => $this->faker->email(),
            'contact_number' => $this->faker->phoneNumber(),
            'gender' => array_rand(Resident::GENDERS),
            'house_number' => $this->faker->buildingNumber(),
            'street' => $this->faker->streetAddress(),
            'area' => $this->faker->streetAddress(),
            'place_of_birth' => $this->faker->city(),
            'birth_date' => $this->faker->date(),
        ];
    }
}
