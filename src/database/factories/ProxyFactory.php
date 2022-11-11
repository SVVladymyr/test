<?php

namespace Database\Factories;

use Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Proxy>
 */
class ProxyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'ip'       => $this->faker->localIpv4(),
            'port'     => $this->faker->randomDigit(),
            'login'    => $this->faker->userName(),
            'password' => $this->faker->password()
        ];
    }
}
