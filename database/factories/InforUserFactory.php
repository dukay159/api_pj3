<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\InforUser;
use Faker\Generator as Faker;

class InforUserFactory extends Factory
{
    protected $model = \App\Models\InforUser::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'hoten' => $this->faker->firstName,
            'ngaysinh' => $this->faker->date,
            'sdt' => $this->faker->phoneNumber,
            'diachi' => $this->faker->address,
        ];
    }
}
