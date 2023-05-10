<?php

namespace Database\Factories;

use App\Models\Country;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;


class StateFactory extends Factory
{
    public function definition(): array
    {
        // create a faker instance based on the factory locale.
        $faker = FakerFactory::create('pt_BR');
        $country= Country::where('code', 'BR')->first();

        return [
            'name' => $faker->unique()->state($country),
            'country_id' => $country,
        ];
    }
}
