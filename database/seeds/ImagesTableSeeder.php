<?php

use App\Image;
use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class ImagesTableSeeder extends Seeder
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

        $imageUrls = array(
            "images/001",
            "images/002",
            "images/003",
            "images/004",
            "images/005",
            "images/006",
            "images/007",
            "images/008",
        );

        foreach ($imageUrls as $imageUrl){
            Image::create([
                'title' =>  $faker->text(80),
                'description' => $content = $faker->paragraph(18),
                'thumbnail' => $imageUrl.".jpg",
                'imageUrl' => "assets/".$imageUrl.".jpg",
                'user_id' => $faker->numberBetween($min = 1, $max = 5)
            ]);
        }
    }
}
