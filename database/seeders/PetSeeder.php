<?php

namespace Database\Seeders;

use App\Models\People;
use App\Models\Pet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $personIds = People::pluck('id')->toArray(); // obtenemos todos los IDs válidos

        foreach (range(1, 30) as $i) {
            Pet::create([
                'name' => $faker->firstName,
                'species' => $faker->randomElement(['Dog', 'Cat', 'Rabbit', 'Bird']),
                'breed' => $faker->word,
                'age' => $faker->numberBetween(1, 15),
                'image' => $faker->imageUrl(400, 300, 'animals', true),
                'person_id' => $faker->randomElement($personIds)
            ]);
        }
    }
}
