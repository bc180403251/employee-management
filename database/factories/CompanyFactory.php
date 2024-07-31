<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'name' => $this->faker->company,
            'email' => $this->faker->unique()->safeEmail,
            'logo' => $this->faker->imageUrl(200, 200, 'business', true, 'logo'),
            'website' => $this->faker->url,
            'phone' => $this->faker->unique()->phoneNumber,
            'address' => $this->faker->address,
            'password' => Hash::make('password'), // You can use a fixed password for simplicity
            'screenshot_time' => $this->faker->dateTimeThisYear, // Example date-time for screenshot time
            'no_of_employees' => $this->faker->numberBetween(1, 1000),
            'allowed_email' => $this->faker->unique()->safeEmail,
            'status' => $this->faker->boolean,
        ];
    }
}
