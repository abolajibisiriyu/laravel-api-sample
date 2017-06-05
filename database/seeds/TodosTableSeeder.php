<?php

use Illuminate\Database\Seeder;

use App\Todo;

use Faker\Factory as Faker;

class TodosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create();

        for ($i=0; $i<5; $i++){
            Todo::create([
                'title' => $faker->sentence(6),
                'description' => $faker->paragraph(8),
                'active' => $faker->boolean(50)
            ]);
        }
    }
}
