<?php

namespace Database\Factories;

use App\Models\Kontak;
use Illuminate\Database\Eloquent\Factories\Factory;

class KontakFactory extends Factory
{
    protected $model = Kontak::class;

    public function definition(): array
    {
    	return [
            "nama"=>$this->faker->name,
            "nomor_hp"=>$this->faker->phoneNumber,
    	];
    }
}