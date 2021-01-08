<?php

namespace Database\Factories;

use App\Referrer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class ReferrerFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Referrer::class;

    /**
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->domainName,
            'email' => $this->faker->email,
            'token' => Hash::make($this->faker->uuid),
        ];
    }
}
