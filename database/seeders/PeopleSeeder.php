<?php

namespace Database\Seeders;

use App\Models\People;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PeopleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 20) as $i) {
            People::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'birthday' => $faker->date('Y-m-d', '2005-12-31') // fecha entre 1900 y 2005
            ]);
        }
    }
}
