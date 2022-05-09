<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Factories\ProductFactory;
use App\Models\Product;
use Illuminate\Support\Str;
use Faker\Factory as Faker;



class ProductSeeder extends Seeder
{
    private $productData = [];

    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $faker = Faker::create();

        for ($i=0; $i < 50000; $i++) {
            $productData[] = [
                'title' => $faker->unique()->name(),
                'description'=> $faker->text(),
                'image' =>'762cedf5ec60d6ac0d74282f50ebec6a.png',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ];
        }


        $chunks = array_chunk($productData, 2000);

        foreach ($chunks as $chunk) {
            Product::insert($chunk);
        }
    }
}
