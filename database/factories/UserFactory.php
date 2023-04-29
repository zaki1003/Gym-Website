<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * 
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [

            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'is_verifications' => 1,
            'email_verified_at' => now(),
            'national_id' => $this->faker->numerify('#########'), // "9 Numbers"
            'password' => bcrypt('123456789'),
            'remember_token' => Str::random(10),
            'gender' => rand(1, 2),
            'profile_image' => $this->faker->imageUrl($width = 200, $height = 200),
            'birth_date' => $this->faker->dateTimeBetween('1990-01-01', '2003-12-31')->format('Y/m/d'), // outputs something like 17/09/2001
            'last_login_at' => $this->faker->dateTimeBetween('-1 month', '+1 month'),
            'subscription_start' => $this->faker->dateTimeBetween('2023-04-15', '2023-05-01')->format('Y/m/d'),
            'subscription_end' => $this->faker->dateTimeBetween('2023-05-02', '2023-06-30')->format('Y/m/d'),

        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
